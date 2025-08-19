<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => "Super Admin",
            'email' => "admin@gmail.com",
            'bio' => "This is the super admin account.",
            'image' => '/default-images/avatar/admin.png',
            'password' => bcrypt("12345678"),
        ]);
    }
}
