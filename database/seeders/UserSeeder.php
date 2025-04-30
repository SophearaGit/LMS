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
                'approval_status' => 'pending',
            ],
            [
                'name' => "teacher",
                'email' => "teacher@gmail.com",
                'password' => bcrypt("12345678"),
                'role' => 'instructor',
                'approval_status' => 'approved',
            ],
            [
                'name' => "hengly",
                'email' => "lenghengly@gmail.com",
                'password' => bcrypt("12345678"),
                'role' => 'instructor',
                'approval_status' => 'pending',
            ],
            [
                'name' => "kheng",
                'email' => "kheng@gmail.com",
                'password' => bcrypt("12345678"),
                'role' => 'instructor',
                'approval_status' => 'pending',
            ],
            [
                'name' => "chunly",
                'email' => "chunly@gmail.com",
                'password' => bcrypt("12345678"),
                'role' => 'instructor',
                'approval_status' => 'pending',
            ],
            [
                'name' => "sopheak",
                'email' => "sopheak@gmail.com",
                'password' => bcrypt("12345678"),
                'role' => 'instructor',
                'approval_status' => 'pending',
            ],
        ];
        User::insert($user);
    }
}
