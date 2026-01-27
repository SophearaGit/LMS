<?php

namespace Database\Seeders;

use App\Models\InstructorPayoutInformation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class InstructorPayoutInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InstructorPayoutInformation::insert([
            'instructor_id' => 2,
            'gateway' => '',
            'information' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
