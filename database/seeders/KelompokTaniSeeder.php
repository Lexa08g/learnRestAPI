<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelompokTaniSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kelompok_tanis')->delete();
        DB::table('petanis')->delete();

        DB::table('kelompok_tanis')->insert([
            ['id_kelompok_tani' => 1, 'nama_kelompok' => 'Jaya Mula', 'created_at' => now(), 'updated_at' => now()],
            ['id_kelompok_tani' => 2, 'nama_kelompok' => 'Tani Maju', 'created_at' => now(), 'updated_at' => now()],
            ['id_kelompok_tani' => 3, 'nama_kelompok' => 'Subak Melte', 'created_at' => now(), 'updated_at' => now()],
            ['id_kelompok_tani' => 4, 'nama_kelompok' => 'Suka Mula', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('petanis')->insert([
            [
                'id_kelompok_tani' => 1,
                'nama'             => 'I Wayan Sudarma',
                'nik'              => '5102011204850001',
                'alamat'           => 'Desa Singapadu, Sukawati, Gianyar',
                'telp'             => '081234567890',
                'foto'             => 'uploads/petanis/petani1.png',
                'status'           => 'Y',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'id_kelompok_tani' => 2,
                'nama'             => 'I Made Suartana',
                'nik'              => '5102021508880002',
                'alamat'           => 'Desa Tegalalang, Gianyar',
                'telp'             => '081987654321',
                'foto'             => 'uploads/petanis/petani2.png',
                'status'           => 'Y',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'id_kelompok_tani' => 3,
                'nama'             => 'I Ketut Gede Arta',
                'nik'              => '5103012211900003',
                'alamat'           => 'Desa Ubud, Gianyar',
                'telp'             => '085712349876',
                'foto'             => 'uploads/petanis/petani3.png',
                'status'           => 'Y',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'id_kelompok_tani' => 1,
                'nama'             => 'I Nyoman Darmawan',
                'nik'              => '5102013009920004',
                'alamat'           => 'Banjar Kebon, Singapadu, Gianyar',
                'telp'             => '082145678901',
                'foto'             => null,
                'status'           => 'Y',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'id_kelompok_tani' => 4,
                'nama'             => 'I Komang Wira Yuda',
                'nik'              => '5104011802950005',
                'alamat'           => 'Desa Payangan, Gianyar',
                'telp'             => '087860123456',
                'foto'             => null,
                'status'           => 'Y',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'id_kelompok_tani' => 2,
                'nama'             => 'I Gede Putu Santosa',
                'nik'              => '5102020406870006',
                'alamat'           => 'Desa Pujung Kaja, Tegalalang',
                'telp'             => '083119876543',
                'foto'             => null,
                'status'           => 'N',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ]);
    }
}
