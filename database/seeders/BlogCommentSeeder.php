<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogIds = Blog::pluck('id')->toArray();
        BlogComment::insert([
            [
                'blog_id' => rand(1, count($blogIds)),
                'user_id' => 1,
                'comment' => 'This is a great blog post! I learned a lot.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_id' => rand(1, count($blogIds)),
                'user_id' => 1,
                'comment' => 'I found this article very informative. Thank you for sharing!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_id' => rand(1, count($blogIds)),
                'user_id' => 1,
                'comment' => 'Interesting perspective! I appreciate the insights.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_id' => rand(1, count($blogIds)),
                'user_id' => 1,
                'comment' => 'This blog post sparked some great ideas for me. Thanks!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_id' => rand(1, count($blogIds)),
                'user_id' => 1,
                'comment' => 'I love the way you explained this topic. Very clear and concise.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_id' => rand(1, count($blogIds)),
                'user_id' => 1,
                'comment' => 'Great read! I will definitely share this with my friends.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_id' => rand(1, count($blogIds)),
                'user_id' => 1,
                'comment' => 'This is exactly what I needed to read today. Thank you!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_id' => rand(1, count($blogIds)),
                'user_id' => 1,
                'comment' => 'I appreciate the depth of research in this article.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_id' => rand(1, count($blogIds)),
                'user_id' => 1,
                'comment' => 'This blog post has given me a new perspective on the topic. Well done!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_id' => rand(1, count($blogIds)),
                'user_id' => 1,
                'comment' => 'I always look forward to your posts. Keep up the great work!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
