<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        User::factory(100)->create()->each(function ($user) {

            // Har bir user uchun 2–5 ta post yaratamiz
            $posts = Post::factory(rand(2, 5))
                ->for($user)
                ->create();

            // Har bir post uchun 5–10 ta comment yaratamiz
            $posts->each(function ($post) {
                Comment::factory(rand(5, 10))
                    ->for($post)
                    ->create();
            });
        });
    }
}
