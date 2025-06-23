<?php

namespace Database\Seeders;

use App\Models\Counter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Counter::create([
            'counter_one' => 745,
            'title_one' => 'LEARNERS & COUNTING',
            'counter_two' => 578,
            'title_two' => 'COURSES & VIDEO',
            'counter_three' => 2457,
            'title_three' => 'CERTIFIED STUDENTS',
            'counter_four' => 378,
            'title_four' => 'Best Professors',
        ]);
    }
}
