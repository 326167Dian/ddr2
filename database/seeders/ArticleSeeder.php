<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Teknologi AI di Era Digital',
                'content' => 'Artificial Intelligence (AI) semakin berperan penting dalam berbagai bidang seperti kesehatan, pendidikan, dan bisnis.',
                'author' => 'Chairul Imam',
                'published_at' => now(),
            ],
            [
                'title' => 'Tips Belajar Laravel untuk Pemula',
                'content' => 'Laravel adalah framework PHP yang sangat powerful dan mudah digunakan untuk membangun aplikasi web modern.',
                'author' => 'Chairul Imam',
                'published_at' => now(),
            ],
            [
                'title' => 'Perkembangan Web3 di Indonesia',
                'content' => 'Web3 membawa konsep desentralisasi yang mulai diterapkan di beberapa startup teknologi di Indonesia.',
                'author' => 'Chairul Imam',
                'published_at' => now(),
            ],
        ];

        foreach ($articles as $data) {
            Article::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'content' => $data['content'],
                'banner' => 'https://via.placeholder.com/800x400.png?text=Banner+Artikel', // contoh dummy
                'author_id' => 1, // pastikan user ID 1 ada
                'published_at' => $data['published_at'],
            ]);
        }
    }
}
