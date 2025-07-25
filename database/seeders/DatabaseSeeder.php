<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

// use App\Models\BlogCategory;
// use App\Models\Setting;
// use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            CourseLanguageSeeder::class,
            CourseLevelSeeder::class,
            CourseCategorySeeder::class,
            CourseSeeder::class,
            CourseChapterSeeder::class,
            CourseChapterLessonsSeeder::class,
            PaymentSettingSeeder::class,
            PayoutGatewaySeeder::class,
            SettingSeeder::class,
            InstructorPayoutInformationSeeder::class,
            CertificateBuilderSeeder::class,
            CertificateBuilderItemSeeder::class,
            HeroSeeder::class,
            FeatureSeeder::class,
            AboutUsSectionSeeder::class,
            LatestCourseSectionSeeder::class,
            BecomeInstructorSectionSeeder::class,
            VideoSectionSeeder::class,
            BrandSeeder::class,
            FeaturedInstructorSectionSeeder::class,
            TestimonialSeeder::class,
            CounterSeeder::class,
            ContactSeeder::class,
            ContactSettingSeeder::class,
            TopBarSeeder::class,
            FooterSeeder::class,
            SocialLinkSeeder::class,
            FooterColumnOneSeeder::class,
            FooterColumnTwoSeeder::class,
            BlogCategorySeeder::class,
            BlogSeeder::class,
            BlogCommentSeeder::class,
        ]);
    }
}
