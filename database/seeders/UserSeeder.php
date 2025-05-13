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
                'name' => "Student Raa",
                'headline' => "Web Developer",
                'email' => "student@gmail.com",
                'bio' => "I am a web developer",
                'password' => bcrypt("23456789"),
                'role' => 'student',
                'approval_status' => 'pending',
                'facebook' => 'https://www.facebook.com/sethsopheara',
                'x' => 'https://www.facebook.com/sethsopheara',
                'linkedin' => 'https://www.facebook.com/sethsopheara',
                'website' => 'https://www.facebook.com/sethsopheara',
                'github' => 'https://www.facebook.com/sethsopheara',
            ],
            [
                'name' => "Teacher Raa",
                'headline' => "Web Developer",
                'email' => "teacher@gmail.com",
                'bio' => "I am a web developer",
                'password' => bcrypt("12345678"),
                'role' => 'instructor',
                'approval_status' => 'approved',
                'facebook' => 'https://www.facebook.com/sethsopheara',
                'x' => 'https://www.facebook.com/sethsopheara',
                'linkedin' => 'https://www.facebook.com/sethsopheara',
                'website' => 'https://www.facebook.com/sethsopheara',
                'github' => 'https://www.facebook.com/sethsopheara',
            ],
            [
                'name' => "hengly",
                'headline' => "Web Developer",
                'email' => "lenghengly-t@gmail.com",
                'bio' => "I am a web developer",
                'password' => bcrypt("12345678"),
                'role' => 'instructor',
                'approval_status' => 'pending',
                'facebook' => '',
                'x' => '',
                'linkedin' => '',
                'website' => '',
                'github' => '',
            ],
            [
                'name' => "kheng",
                'headline' => "Web Developer",
                'email' => "kheng@gmail.com",
                'bio' => "I am a web developer",
                'password' => bcrypt("12345678"),
                'role' => 'instructor',
                'approval_status' => 'pending',
                'facebook' => '',
                'x' => '',
                'linkedin' => '',
                'website' => '',
                'github' => '',
            ],
            [
                'name' => "chunly",
                'headline' => "Web Developer",
                'email' => "chunly@gmail.com",
                'bio' => "I am a web developer",
                'password' => bcrypt("12345678"),
                'role' => 'instructor',
                'approval_status' => 'pending',
                'facebook' => '',
                'x' => '',
                'linkedin' => '',
                'website' => '',
                'github' => '',
            ],
            [
                'name' => "sopheak",
                'headline' => "Web Developer",
                'email' => "sopheak@gmail.com",
                'bio' => "I am a web developer",
                'password' => bcrypt("12345678"),
                'role' => 'instructor',
                'approval_status' => 'pending',
                'facebook' => '',
                'x' => '',
                'linkedin' => '',
                'website' => '',
                'github' => '',
            ],
        ];
        User::insert($user);
    }
}
