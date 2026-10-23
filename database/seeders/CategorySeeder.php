<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['category_id' => 1, 'category' => 'Indie Rock', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 2, 'category' => 'Dream Pop / Ambient Pop', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 3, 'category' => 'Alternative Rock / Grunge', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($categories as $cat) {
            DB::table('categories')->updateOrInsert(
                ['category_id' => $cat['category_id']],
                $cat
            );
        }

        DB::table('categories')->whereNotIn('category_id', [1, 2, 3])->delete();
    }
}
