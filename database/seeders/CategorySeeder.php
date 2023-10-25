<?php

namespace Database\Seeders;

use App\Models\Category;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category::factory()->create(['name' => 'Designer']);
        // Category::factory()->create(['name' => 'Programmer']);
        $categories = [
            'designer',
            'programmer'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
