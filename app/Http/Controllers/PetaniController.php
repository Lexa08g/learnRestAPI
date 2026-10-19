<?php

namespace App\Http\Controllers;

use App\Models\KelompokTani;
use App\Models\Petani;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PetaniController extends Controller
{
    public function index(Request $request)
    {
        $title = "Daftar Petani";

        $query = Petani::with('kelompoktani');

        if ($request->filled('s')) {
            $query->where('nama', 'like', "%{$request->s}%");
        }

        if ($request->filled('id_kelompok')) {
            $query->where('id_kelompok_tani', $request->id_kelompok);
        }

        $petanis = $query->paginate(5);
        $kelompoks = KelompokTani::all();

        return view('admin.daftarpetani', compact('title', 'petanis', 'kelompoks'));
    }

    public function create()
    {
        $title = "Input Petani";
        $kelompoks = KelompokTani::all();

        return view('admin.inputpetani', compact('title', 'kelompoks'));
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => 'Kolom :attribute harus lengkap.',
            'numeric'  => 'Kolom :attribute harus berupa angka.',
            'file'     => 'Perhatikan format dan ukuran file foto.',
            'mimes'    => 'Foto harus berformat PNG atau JPG.',
            'max'      => 'Ukuran foto maksimal 2MB.',
        ];

        $validasi = $request->validate([
            'nik'              => 'required|numeric',
            'nama'             => 'required|string|max:255',
            'alamat'           => 'nullable|string|max:255',
            'telp'             => 'required|string|max:30',
            'foto'             => 'required|mimes:png,jpg,jpeg|max:2048',
            'id_kelompok_tani' => 'required|exists:kelompok_tanis,id_kelompok_tani',
            'status'           => 'nullable|string|in:Y,N',
        ], $messages);

        try {
            DB::transaction(function () use ($request, $validasi) {
                if ($request->hasFile('foto')) {
                    $fileName = time() . '_' . $request->file('foto')->getClientOriginalName();
                    $path = $request->file('foto')->storeAs('uploads/petanis', $fileName, 'public');
                    $validasi['foto'] = $path;
                }

                if (empty($validasi['status'])) {
                    $validasi['status'] = 'Y';
                }

                Petani::create($validasi);
            });

            return redirect()->route('petani.index')->with('success', 'Data petani berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $petani = Petani::with('kelompoktani')->findOrFail($id);
        $title = "Detail " . $petani->nama;

        return view('admin.inputpetani', compact('title', 'petani'));
    }

    public function edit($id)
    {
        $petani = Petani::findOrFail($id);
        $kelompoks = KelompokTani::all();
        $title = "Edit Data " . $petani->nama;

        return view('admin.inputpetani', compact('title', 'kelompoks', 'petani'));
    }

    public function update(Request $request, $id)
    {
        $petani = Petani::findOrFail($id);

        $validasi = $request->validate([
            'nik'              => 'required|numeric',
            'nama'             => 'required|string|max:255',
            'alamat'           => 'nullable|string|max:255',
            'telp'             => 'required|string|max:30',
            'foto'             => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'id_kelompok_tani' => 'required|exists:kelompok_tanis,id_kelompok_tani',
            'status'           => 'nullable|string|in:Y,N',
        ]);

        try {
            DB::transaction(function () use ($request, $petani, $validasi) {
                if ($request->hasFile('foto')) {
                    if ($petani->foto && Storage::disk('public')->exists($petani->foto)) {
                        Storage::disk('public')->delete($petani->foto);
                    }

                    $fileName = time() . '_' . $request->file('foto')->getClientOriginalName();
                    $path = $request->file('foto')->storeAs('uploads/petanis', $fileName, 'public');
                    $validasi['foto'] = $path;
                }

                $petani->update($validasi);
            });

            return redirect()->route('petani.index')->with('success', 'Data petani berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $petani = Petani::find($id);
                if ($petani) {
                    if ($petani->foto && Storage::disk('public')->exists($petani->foto)) {
                        Storage::disk('public')->delete($petani->foto);
                    }
                    $petani->delete();
                }
            });

            return redirect()->route('petani.index')->with('success', 'Data petani berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('petani.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function kelompok($id)
    {
        $kelompok = KelompokTani::where('id_kelompok_tani', $id)->firstOrFail();
        $title = 'Kelompok ' . $kelompok->nama_kelompok;

        $petanis = $kelompok->petanis()->with('kelompoktani')->paginate(5);
        $kelompoks = KelompokTani::all();

        return view('admin.daftarpetani', compact('title', 'petanis', 'kelompoks'));
    }
}