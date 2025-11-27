<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Prestasi',
            'Opini',
            'Kegiatan',
            'Informasi Sekolah'
        ];

        foreach ($categories as $category) {
            Kategori::create([
                'nama_kategori' => $category
            ]);
        }
    }
}