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
                'image' => '/default-images/avatar/student_girl.png',
                'password' => bcrypt("12345678"),
                'role' => 'student',
                'approval_status' => 'rejected',
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
                'image' => '/default-images/avatar/teacher.png',
                'password' => bcrypt("12345678"),
                'role' => 'instructor',
                'approval_status' => 'approved',
                'facebook' => 'https://www.facebook.com/sethsopheara',
                'x' => 'https://www.facebook.com/sethsopheara',
                'linkedin' => 'https://www.facebook.com/sethsopheara',
                'website' => 'https://www.facebook.com/sethsopheara',
                'github' => 'https://www.facebook.com/sethsopheara',
            ]
        ];

        User::insert($user);
    }
}
