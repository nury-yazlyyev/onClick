<?php

namespace Database\Factories;

use App\Models\ProductVariation;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariationFactory extends Factory
{
    protected $model = ProductVariation::class;

    public function definition()
    {
        return [
            'product_id' => Product::inRandomOrder()->first()->id,
            'size_id'    => Size::inRandomOrder()->first()->id,
            'color_id'   => Color::inRandomOrder()->first()->id,
            'stock'      => fake()->numberBetween(0, 50),
            'price'      => fake()->randomFloat(2, 20, 300),
        ];
    }
}
