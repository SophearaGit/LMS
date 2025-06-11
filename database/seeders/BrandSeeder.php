<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 6; $i++) {
            Brand::create([
                'image' => "/default-images/brand-section-images/brand_icon_{$i}.png",
                'url' => 'https://neal.fun/internet-roadtrip/',
                'status' => 1,
            ]);
        }
    }
}
