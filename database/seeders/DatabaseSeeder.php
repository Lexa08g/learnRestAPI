<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'     => 'Admin Petani',
                'password' => Hash::make('password123'),
                'role'     => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name'     => 'Petani Member',
                'password' => Hash::make('password123'),
                'role'     => 'user',
            ]
        );

        $this->call([
            KelompokTaniSeeder::class,
        ]);
    }
}
