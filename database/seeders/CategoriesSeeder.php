<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Nature',
            ],
            [
                'id' => 2,
                'name' => 'Home',
            ],
            [
                'id' => 3,
                'name' => 'City',
            ],
            [
                'id' => 4,
                'name' => 'Music',
            ],
            [
                'id' => 5,
                'name' => 'Sports',
            ],
            [
                'id' => 6,
                'name' => 'Science',
            ], [
                'id' => 7,
                'name' => 'Computers',
            ],
        ]);
    }
}
