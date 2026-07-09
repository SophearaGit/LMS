<?php
namespace Database\Seeders;
use App\Models\Contact;
use Illuminate\Database\Seeder;
class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts = [
            [
                'icon' => '/default-images/contact/contact_icon_1.webp',
                'title' => 'Phone Number',
                'line_one' => '+855 96 564 8889',
                'line_two' => '+855 10 564 888',
                'status' => 1,
            ],
            [
                'icon' => '/default-images/contact/contact_icon_2.webp',
                'title' => 'Email Address',
                'line_one' => 'info@cait.com.kh',
                'line_two' => 'support@cait.com.kh',
                'status' => 1,
            ],
            [
                'icon' => '/default-images/contact/contact_icon_3.webp',
                'title' => 'Office Address',
                'line_one' => 'Phnom Penh, Cambodia',
                'line_two' => 'C.A.I.T Digitalization Co., Ltd.',
                'status' => 1,
            ],
            [
                'icon' => '/default-images/contact/contact_icon_4.webp',
                'title' => 'Working Hours',
                'line_one' => 'Monday - Friday',
                'line_two' => '08:00 AM - 05:30 PM',
                'status' => 1,
            ],
        ];
        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
}
