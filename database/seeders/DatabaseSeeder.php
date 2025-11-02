<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
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

        $this->call(CategorySeeder::class);
        
        User::factory(100)->create();
        Product::factory(150)->create();
       
        Vendor::where('id', 1)->update([
            'name' => 'Nury Sport',
        ]);
        
        }
}
