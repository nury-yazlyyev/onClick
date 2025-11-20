<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['Siyah',         '#000000'],
            ['Beyaz',         '#FFFFFF'],
            ['Kırmızı',       '#FF0000'],
            ['Lacivert',      '#000080'],
            ['Mavi',          '#1E90FF'],
            ['Gri',           '#808080'],
            ['Açık Gri',      '#D3D3D3'],
            ['Koyu Gri',      '#4F4F4F'],
            ['Yeşil',         '#008000'],
            ['Zeytin Yeşili', '#556B2F'],
            ['Haki',          '#8A9A5B'],
            ['Kahverengi',    '#8B4513'],
            ['Bej',           '#F5F5DC'],
            ['Ten Rengi',     '#FFDFC4'],
            ['Turuncu',       '#FFA500'],
            ['Sarı',          '#FFFF00'],
            ['Mor',           '#800080'],
            ['Pembe',         '#FFC0CB'],
            ['Fuşya',         '#FF00AA'],
            ['Bordo',         '#800000'],
            ['Koyu Kahverengi', '#5C4033'],
            ['Petrol Mavisi', '#274e55'],
            ['Gold',          '#D4AF37'],
            ['Gümüş',         '#C0C0C0'],
            ['Krem',          '#FFFDD0'],
            ['Mint Yeşili',   '#98FF98'],
            ['Antrasit',      '#2F2F2F'],
        ];

        foreach ($colors as $color)
        {
            Color::create([
                'name' => $color[0],
                'hex_code' => $color[1],
            ]);
        }
    }
}
