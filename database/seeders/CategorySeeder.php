<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Prestasi', 'slug' => 'prestasi', 'description' => 'Artikel tentang prestasi siswa dan sekolah'],
            ['name' => 'Opini', 'slug' => 'opini', 'description' => 'Artikel opini dan pendapat'],
            ['name' => 'Kegiatan', 'slug' => 'kegiatan', 'description' => 'Informasi kegiatan sekolah'],
            ['name' => 'Informasi Sekolah', 'slug' => 'informasi-sekolah', 'description' => 'Informasi umum sekolah'],
            ['name' => 'Pengumuman', 'slug' => 'pengumuman', 'description' => 'Pengumuman resmi sekolah'],
            ['name' => 'Berita', 'slug' => 'berita', 'description' => 'Berita terkini sekolah']
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}