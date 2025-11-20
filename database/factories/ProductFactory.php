<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Vendor;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $vendor = Vendor::inRandomOrder()->first();
        $category = Category::inRandomOrder()->first();

        return [
            'vendor_id' => $vendor->id,
            'category_id' => $category->id,
            'img_path' => null,
            'name' => fake()->sentence(3),
            'price' => fake()->numberBetween(50, 1000),
            'description' => fake()->sentence(),
            'description_tm' => fake()->sentence(),
            'description_ru' => fake()->sentence(),
        ];
    }
}
