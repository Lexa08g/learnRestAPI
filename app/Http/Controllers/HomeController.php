<?php

namespace App\Http\Controllers;

use App\Models\KelompokTani;
use App\Models\Petani;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $petanis = Petani::with('kelompoktani')->where('status', 'Y')->take(6)->get();
        $kelompoks = KelompokTani::withCount('petanis')->get();

        return view('frontpage.landingpage', [
            'title'     => 'Portal Informasi Kelompok Petani',
            'petanis'   => $petanis,
            'kelompoks' => $kelompoks,
        ]);
    }

    public function promo()
    {
        return view('frontpage.promo', [
            'title' => 'Program Bantuan & Bibit Pertanian'
        ]);
    }

    public function katalog()
    {
        $petanis = Petani::with('kelompoktani')->paginate(8);

        return view('frontpage.katalog', [
            'title'   => 'Daftar Anggota & Kelompok Tani',
            'petanis' => $petanis,
        ]);
    }

    public function tentang()
    {
        $totalPetani = Petani::count();
        $totalKelompok = KelompokTani::count();

        return view('frontpage.tentang', [
            'title'         => 'Tentang Sistem Informasi Pertanian',
            'totalPetani'   => $totalPetani,
            'totalKelompok' => $totalKelompok,
        ]);
    }
}