<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\User;
use App\Models\Vendor;
use Database\Factories\ProductVariationFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
                'username' => 'Nury Sport',
                'is_seller' => true
            ]);

        Admin::create([
            'username' => 'nury-yazlyyev',
            'password' => bcrypt('NurySport10Mkr'),
            'email' => 'dontsteal006@gmail.com',
            'phone' => '+99361973223'
        ]);

        $this->call(CategorySeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(ColorSeeder::class);

        User::factory(50)->create();
        Product::factory()
            ->count(10)
            ->create()
            ->each(function ($product) {
                ProductVariation::factory()
                    ->count(3)
                    ->create([
                        'product_id' => $product->id
                    ]);
            });


        Vendor::where('id', 1)->update([
            'name' => 'Nury Sport',
        ]);

        $users = User::all();
        $products = Product::all();

        foreach ($users as $user) {
            foreach ($products as $product) {
                if (rand(0, 1)) {
                    Comment::create([
                        'product_id' => $product->id,
                        'user_id' => $user->id,
                        'comment' => 'Amazing product, I loved it, bought it in Australia, good job guys!))'
                    ]);
                }
            }
        }
    }
}
