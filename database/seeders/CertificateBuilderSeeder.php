<?php

namespace Database\Seeders;

use App\Models\CertificateBuilder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CertificateBuilderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CertificateBuilder::insert([
            'background' => public_path('\default-images\certificate-info\certificate.png'),
            'title' => '[student_name]',
            'subtitle' => '[student_name] has successfully completed this [course_name] from [plateform_name].',
            'description' => '[student_name], [course_name], [date], [plateform_name], [instructor_name]',
            'signature' => public_path('\default-images\certificate-info\signatureFake.png'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
