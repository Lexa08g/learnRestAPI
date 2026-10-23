<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->delete();

        $products = [
            [
                'product_id'  => 1,
                'name'        => 'AM',
                'slug'        => 'am-arctic-monkeys',
                'artist'      => 'Arctic Monkeys',
                'format'      => 'Vinyl LP (180g)',
                'price'       => 495000,
                'stock'       => 15,
                'img'         => null,
                'category_id' => 1,
                'description' => "Album studio kelima legendaris dari Arctic Monkeys dengan hits 'Do I Wanna Know?' dan 'R U Mine?'. Format vinyl 180 gram heavyweight.",
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'product_id'  => 2,
                'name'        => 'Cigarettes After Sex',
                'slug'        => 'cigarettes-after-sex-self-titled',
                'artist'      => 'Cigarettes After Sex',
                'format'      => 'Vinyl LP',
                'price'       => 480000,
                'stock'       => 10,
                'img'         => null,
                'category_id' => 2,
                'description' => "Self-titled album debut ikonik yang menyajikan alunan slowcore dan dream pop khas Greg Gonzalez.",
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'product_id'  => 3,
                'name'        => 'Siamese Dream',
                'slug'        => 'siamese-dream-the-smashing-pumpkins',
                'artist'      => 'The Smashing Pumpkins',
                'format'      => 'Double Vinyl LP',
                'price'       => 650000,
                'stock'       => 8,
                'img'         => null,
                'category_id' => 3,
                'description' => "Karya monumental Billy Corgan & The Smashing Pumpkins dengan dinding fuzz gitar yang megah.",
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ];

        foreach ($products as $prod) {
            DB::table('products')->insert($prod);
        }
    }
}
