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
        $categories = [
            'T-shirt',
            'Pants',
            'Shoes',
            'Jeans',
            'Caps',
        ];

        foreach ( $categories as $category){
            $c = Category::create([
                'name' => $category,
            ]);
        }
    }
}
