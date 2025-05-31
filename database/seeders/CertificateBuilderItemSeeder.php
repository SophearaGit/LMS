<?php

namespace Database\Seeders;

use App\Models\CertificateBuilderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CertificateBuilderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CertificateBuilderItem::insert([
            [
                'id' => 5,
                'element_id' => 'title',
                'x_position' => 0,
                'y_position' => 221,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'element_id' => 'subtitle',
                'x_position' => 0,
                'y_position' => 229,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'element_id' => 'signature',
                'x_position' => 0,
                'y_position' => 312,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'element_id' => 'description',
                'x_position' => 0,
                'y_position' => 239,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
