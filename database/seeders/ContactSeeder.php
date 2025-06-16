<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        for ($i = 1; $i <= 4; $i++) {
            Contact::create([
                'icon' => '/default-images/contact/contact_icon_' . $i . '.png',
                'title' => $faker->sentence(3),
                'line_one' => $faker->phoneNumber(),
                'line_two' => $faker->phoneNumber(),
                'status' => 1,
            ]);
        }
    }
}
