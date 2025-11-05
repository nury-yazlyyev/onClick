<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\text;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
   
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $img = 'public/images/post-images/3NGalczThG1DKEnRc0Aj6UkRPkOWSK22tKbVAt9n.jpg';

        $vendor_id = Vendor::inRandomOrder()->first();
        $category_id = Category::inRandomOrder()->first();
        return [
            'vendor_id' => $vendor_id->id,
            'category_id' => $category_id->id,
            'img_path' =>null,
            'name' => fake()->sentence(3),
            'price' => fake()->numberBetween(50,1000),
            'description' =>fake()->sentence(),
            'description_tm' =>fake()->sentence(),
            'description_ru' =>fake()->sentence(),
        ];
    }
}
