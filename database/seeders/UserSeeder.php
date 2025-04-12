<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => "student",
                'email' => "student@gmail.com",
                'password' => bcrypt("23456789"),
                'role' => 'student',
            ],
            [
                'name' => "teacher",
                'email' => "teacher@gmail.com",
                'password' => bcrypt("12345678"),
                'role' => 'instructor',
            ],
            [
                'name' => "hengly",
                'email' => "lenghengly@gmail.com",
                'password' => bcrypt("12345678"),
                'role' => 'instructor',
            ],
            [
                'name' => "kheng",
                'email' => "kheng@gmail.com",
                'password' => bcrypt("12345678"),
                'role' => 'instructor',
            ],
            [
                'name' => "chunly",
                'email' => "chunly@gmail.com",
                'password' => bcrypt("12345678"),
                'role' => 'instructor',
            ],
            [
                'name' => "sopheak",
                'email' => "sopheak@gmail.com",
                'password' => bcrypt("12345678"),
                'role' => 'instructor',
            ],
        ];
        User::insert($user);
    }
}
