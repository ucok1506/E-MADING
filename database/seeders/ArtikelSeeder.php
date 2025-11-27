<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artikel;
use Carbon\Carbon;

class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'judul' => 'Prestasi Gemilang Siswa SMK BAKNUS 666',
                'isi' => 'Tim robotika SMK BAKNUS 666 berhasil meraih juara 1 dalam Kompetisi Robotika Nasional 2024. Prestasi ini membanggakan dan menunjukkan kualitas pendidikan di sekolah kami.',
                'tanggal' => Carbon::now(),
                'id_user' => 1,
                'id_kategori' => 1,
                'status' => 'publish'
            ],
            [
                'judul' => 'Pengumuman Penerimaan Siswa Baru',
                'isi' => 'SMK BAKNUS 666 membuka pendaftaran siswa baru untuk tahun ajaran 2024/2025. Tersedia berbagai jurusan unggulan dengan fasilitas lengkap.',
                'tanggal' => Carbon::now(),
                'id_user' => 1,
                'id_kategori' => 4,
                'status' => 'publish'
            ],
            [
                'judul' => 'Workshop Digital Marketing',
                'isi' => 'Jurusan Multimedia mengadakan workshop Digital Marketing yang diikuti oleh 60 siswa. Workshop ini sangat bermanfaat untuk mempersiapkan siswa menghadapi dunia kerja.',
                'tanggal' => Carbon::now(),
                'id_user' => 2,
                'id_kategori' => 3,
                'status' => 'publish'
            ]
        ];

        foreach ($articles as $article) {
            Artikel::create($article);
        }
    }
}