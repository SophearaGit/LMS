<?php
namespace Database\Seeders;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;
class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'rating' => 5,
                'review' => 'The ICT Professional Training Center exceeded my expectations. The instructors were knowledgeable, the lessons were practical, and I was able to apply the skills directly to my work.',
                'user_image' => '/default-images/testimonials/avatar-1.webp',
                'user_name' => 'David Kim',
                'user_title' => 'Frontend Developer',
            ],
            [
                'rating' => 5,
                'review' => 'I joined the Web Development course with no prior experience. The curriculum was well structured, and the hands-on projects gave me the confidence to build real applications.',
                'user_image' => '/default-images/testimonials/avatar-2.webp',
                'user_name' => 'Sophia Martinez',
                'user_title' => 'Software Engineering Student',
            ],
            [
                'rating' => 5,
                'review' => 'The trainers explained every concept clearly and were always willing to answer questions. I highly recommend this training center to anyone looking to improve their IT skills.',
                'user_image' => '/default-images/testimonials/avatar-3.webp',
                'user_name' => 'Michael Chen',
                'user_title' => 'IT Support Specialist',
            ],
            [
                'rating' => 4,
                'review' => 'Excellent learning environment with modern teaching methods. The practical assignments helped me gain real-world experience and improve my problem-solving skills.',
                'user_image' => '/default-images/testimonials/avatar-4.webp',
                'user_name' => 'Emily Johnson',
                'user_title' => 'UI/UX Designer',
            ],
            [
                'rating' => 5,
                'review' => 'After completing the Laravel course, I successfully developed my first web application. The instructors provided valuable guidance throughout the entire program.',
                'user_image' => '/default-images/testimonials/avatar-5.webp',
                'user_name' => 'James Wilson',
                'user_title' => 'Full Stack Developer',
            ],
            [
                'rating' => 5,
                'review' => 'The quality of the training was outstanding. From networking fundamentals to advanced programming topics, everything was explained in a clear and practical way.',
                'user_image' => '/default-images/testimonials/avatar-6.webp',
                'user_name' => 'Olivia Brown',
                'user_title' => 'Network Administrator',
            ],
            [
                'rating' => 5,
                'review' => 'This training center helped me prepare for my career in software development. The projects, mentorship, and supportive community made the learning experience enjoyable.',
                'user_image' => '/default-images/testimonials/avatar-7.webp',
                'user_name' => 'Daniel Anderson',
                'user_title' => 'Backend Developer',
            ],
        ];
        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
