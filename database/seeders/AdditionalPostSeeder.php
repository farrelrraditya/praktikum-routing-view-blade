<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class AdditionalPostSeeder extends Seeder
{
    public function run(): void
    {
        $titles = [
            'Belajar Laravel',
            'Dasar Pemrograman Web',
            'Mengenal Database',
            'Membangun Aplikasi',
            'Pengantar Eloquent',
            'Desain Antarmuka Web',
            'Mengelola Data Post',
        ];

        for ($i = 1; $i <= 25; $i++) {
            $title = $titles[array_rand($titles)];

            Post::create([
                'title' => $title . ' #' . $i,
                'description' => 'Data latihan tambahan nomor ' . $i,
            ]);
        }
    }
}