<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PetaniResource;
use App\Models\Petani;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PetaniController extends Controller
{
    public function index(Request $request)
    {
        $query = Petani::with('kelompoktani');

        if ($request->filled('s')) {
            $query->where('nama', 'like', "%{$request->s}%");
        }

        if ($request->filled('id_kelompok')) {
            $query->where('id_kelompok_tani', $request->id_kelompok);
        }

        $petanis = $query->paginate(10);

        return PetaniResource::collection($petanis);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'             => 'required|string|max:255',
            'nik'              => 'required|numeric',
            'alamat'           => 'nullable|string|max:255',
            'telp'             => 'required|string|max:30',
            'foto'             => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'id_kelompok_tani' => 'required|exists:kelompok_tanis,id_kelompok_tani',
            'status'           => 'nullable|string|in:Y,N',
        ]);

        $petani = DB::transaction(function () use ($request, $validated) {
            $path = null;

            if ($request->hasFile('foto')) {
                $fileName = time() . '_' . $request->file('foto')->getClientOriginalName();
                $path = $request->file('foto')->storeAs('uploads/petanis', $fileName, 'public');
            }

            return Petani::create([
                'nama'             => $validated['nama'],
                'nik'              => $validated['nik'],
                'alamat'           => $validated['alamat'] ?? null,
                'telp'             => $validated['telp'],
                'foto'             => $path,
                'id_kelompok_tani' => $validated['id_kelompok_tani'],
                'status'           => $validated['status'] ?? 'Y',
            ]);
        });

        return (new PetaniResource($petani))->response()->setStatusCode(201);
    }

    public function show($id)
    {
        $petani = Petani::with('kelompoktani')->findOrFail($id);

        return new PetaniResource($petani);
    }

    public function update(Request $request, $id)
    {
        $petani = Petani::findOrFail($id);

        $validated = $request->validate([
            'nama'             => 'required|string|max:255',
            'nik'              => 'required|numeric',
            'alamat'           => 'nullable|string|max:255',
            'telp'             => 'required|string|max:30',
            'foto'             => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'id_kelompok_tani' => 'required|exists:kelompok_tanis,id_kelompok_tani',
            'status'           => 'nullable|string|in:Y,N',
        ]);

        $petani = DB::transaction(function () use ($request, $petani, $validated) {
            $path = $petani->foto;

            if ($request->hasFile('foto')) {
                if ($petani->foto && Storage::disk('public')->exists($petani->foto)) {
                    Storage::disk('public')->delete($petani->foto);
                }

                $fileName = time() . '_' . $request->file('foto')->getClientOriginalName();
                $path = $request->file('foto')->storeAs('uploads/petanis', $fileName, 'public');
            }

            $petani->update([
                'nama'             => $validated['nama'],
                'nik'              => $validated['nik'],
                'alamat'           => $validated['alamat'] ?? null,
                'telp'             => $validated['telp'],
                'foto'             => $path,
                'id_kelompok_tani' => $validated['id_kelompok_tani'],
                'status'           => $validated['status'] ?? $petani->status,
            ]);

            return $petani;
        });

        return new PetaniResource($petani);
    }

    public function destroy($id)
    {
        $petani = Petani::find($id);

        if (!$petani) {
            return response()->json([
                'message' => 'Petani tidak ditemukan'
            ], 404);
        }

        DB::transaction(function () use ($petani) {
            if ($petani->foto && Storage::disk('public')->exists($petani->foto)) {
                Storage::disk('public')->delete($petani->foto);
            }
            $petani->delete();
        });

        return response()->json([
            'message' => 'Data petani berhasil dihapus'
        ]);
    }
}
