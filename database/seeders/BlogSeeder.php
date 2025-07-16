<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogCategoryIds = BlogCategory::pluck('id')->toArray();
        Blog::insert([
            [
                'user_id' => 1,
                'blog_category_id' => $blogCategoryIds[array_rand($blogCategoryIds)],
                'image' => '/default-images/blog/blogpost-1.jpg',
                'title' => 'Understanding the Basics of Business Management',
                'slug' => 'understanding-the-basics-of-business-management',
                'description' => '<p>Business management is the backbone of any successful organization. In this blog post, we delve into the <strong>fundamental principles</strong> that drive effective management, such as <em>planning</em>, <em>organizing</em>, <em>leading</em>, and <em>controlling</em>. Understanding these core concepts helps managers set clear objectives, allocate resources efficiently, and motivate teams to achieve common goals.</p>
                <p>We also discuss the importance of <strong>strategic decision-making</strong> and how managers can adapt to changing market conditions. Real-world examples illustrate how strong leadership and communication skills contribute to a productive work environment. Whether you are a new manager or looking to refine your skills, mastering the basics of business management is essential for long-term success.</p>',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'blog_category_id' => $blogCategoryIds[array_rand($blogCategoryIds)],
                'image' => '/default-images/blog/blogpost-2.jpg',
                'title' => 'The Role of Data Science in Modern Business',
                'slug' => 'the-role-of-data-science-in-modern-business',
                'description' => '<p>Data science has revolutionized the way businesses operate, enabling them to make data-driven decisions. In this post, we explore how data science techniques such as <strong>machine learning</strong>, <strong>data mining</strong>, and <strong>predictive analytics</strong> can enhance business strategies.</p>
                <p>We highlight case studies where companies have successfully implemented data science to improve customer experiences, optimize operations, and drive innovation. The blog also covers the skills required for a career in data science and the tools that are essential for data analysis. As businesses continue to generate vast amounts of data, the demand for skilled data scientists is on the rise, making it a lucrative field for aspiring professionals.</p>',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'blog_category_id' => $blogCategoryIds[array_rand($blogCategoryIds)],
                'image' => '/default-images/blog/blogpost-3.jpg',
                'title' => 'Effective Marketing Strategies for Small Businesses',
                'slug' => 'effective-marketing-strategies-for-small-businesses',
                'description' => '<p>Small businesses often face unique challenges when it comes to marketing. This blog post outlines <strong>cost-effective marketing strategies</strong> that can help small businesses reach their target audience without breaking the bank. We discuss the importance of <em>social media marketing</em>, <em>content marketing</em>, and <em>email campaigns</em>.</p>
                <p>Additionally, we provide tips on how to leverage local SEO to attract nearby customers and the benefits of building a strong online presence. By implementing these strategies, small businesses can enhance their visibility, engage with customers, and ultimately drive sales growth.</p>',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'blog_category_id' => $blogCategoryIds[array_rand($blogCategoryIds)],
                'image' => '/default-images/blog/blogpost-4.jpg',
                'title' => 'Health & Fitness: Tips for a Balanced Lifestyle',
                'slug' => 'health-fitness-tips-for-a-balanced-lifestyle',
                'description' => '<p>Maintaining a healthy lifestyle is crucial for overall well-being. In this blog post, we share practical tips for achieving a balanced lifestyle that includes regular exercise, nutritious eating, and mental wellness. We emphasize the importance of setting realistic fitness goals and finding activities that you enjoy.</p>
                <p>We also discuss the benefits of mindfulness and stress management techniques, such as meditation and yoga. By incorporating these practices into your daily routine, you can improve your physical health, boost your mood, and enhance your quality of life. Whether you are a fitness enthusiast or just starting your journey, these tips can help you lead a healthier and happier life.</p>',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'blog_category_id' => $blogCategoryIds[array_rand($blogCategoryIds)],
                'image' => '/default-images/blog/blogpost-5.jpg',
                'title' => 'Exploring the Latest Trends in Finance',
                'slug' => 'exploring-the-latest-trends-in-finance',
                'description' => '<p>The finance industry is constantly evolving, with new trends shaping how we manage money and investments. In this post, we explore the latest developments in finance, including <strong>fintech innovations</strong>, <strong>cryptocurrency</strong>, and <strong>sustainable investing</strong>. We discuss how these trends are transforming traditional financial practices and what they mean for consumers and investors.</p>
                <p>We also provide insights into the future of finance, including the impact of artificial intelligence and blockchain technology. By staying informed about these trends, individuals and businesses can make better financial decisions and adapt to the changing landscape of the financial world.</p>',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'blog_category_id' => $blogCategoryIds[array_rand($blogCategoryIds)],
                'image' => '/default-images/blog/blogpost-6.jpg',
                'title' => 'Lifestyle Changes for a More Fulfilling Life',
                'slug' => 'lifestyle-changes-for-a-more-fulfilling-life',
                'description' => '<p>Making small lifestyle changes can lead to significant improvements in your overall happiness and fulfillment. In this blog post, we discuss various lifestyle adjustments that can enhance your daily routine, such as prioritizing self-care, cultivating positive relationships, and pursuing hobbies that bring joy.</p>
                <p>We also explore the benefits of setting personal goals and creating a balanced work-life schedule. By focusing on what truly matters to you, you can create a more meaningful and satisfying life. Whether it\'s through travel, learning new skills, or simply taking time for yourself, these changes can help you achieve a greater sense of purpose and contentment.</p>',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'blog_category_id' => $blogCategoryIds[array_rand($blogCategoryIds)],
                'image' => '/default-images/blog/blogpost-1.jpg',
                'title' => 'Travel Tips for Your Next Adventure',
                'slug' => 'travel-tips-for-your-next-adventure',
                'description' => '<p>Traveling can be one of life\'s most rewarding experiences, but it also requires careful planning. In this blog post, we share essential travel tips to help you make the most of your next adventure. From choosing the right destination to packing efficiently, we cover all the bases.</p>
                <p>We also discuss the importance of cultural awareness and how to immerse yourself in local customs and traditions. Whether you\'re a seasoned traveler or planning your first trip, these tips will help you navigate the challenges of travel and create unforgettable memories. From budgeting to finding the best accommodations, we provide practical advice to ensure a smooth and enjoyable journey.</p>',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'blog_category_id' => $blogCategoryIds[array_rand($blogCategoryIds)],
                'image' => '/default-images/blog/blogpost-2.jpg',
                'title' => 'Culinary Delights: Exploring Global Cuisines',
                'slug' => 'culinary-delights-exploring-global-cuisines',
                'description' => '<p>Food is a universal language that brings people together. In this blog post, we take you on a culinary journey around the world, exploring diverse cuisines and their unique flavors. From the spicy dishes of Southeast Asia to the rich, hearty meals of Europe, we celebrate the art of cooking and the joy of sharing meals with loved ones.</p>
                <p>We also provide recipes and cooking tips for those who want to try their hand at international dishes. Whether you\'re a food enthusiast or simply looking to expand your palate, this post will inspire you to explore new culinary horizons. Discover the stories behind traditional recipes and learn how food can connect us across cultures and borders.</p>',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
