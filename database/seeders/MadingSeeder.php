<?php

namespace Database\Seeders;

use App\Models\Mading;
use Illuminate\Database\Seeder;

class MadingSeeder extends Seeder
{
    public function run(): void
    {
        Mading::create([
            'title' => 'Selamat Datang di E-Mading SMK BAKNUS 666',
            'content' => 'Selamat datang di platform E-Mading SMK BAKTI NUSANTARA 666! Ini adalah ruang digital untuk berbagi informasi, pengumuman, prestasi, dan artikel inspiratif dari seluruh civitas akademika. Mari bersama-sama membangun komunitas sekolah yang informatif, kreatif, dan berprestasi.',
            'author' => 'Kepala Sekolah',
            'user_id' => 1,
            'category_id' => 4,
            'status' => 'published',
            'is_featured' => true,
            'published_at' => now()
        ]);

        Mading::create([
            'title' => 'Prestasi Siswa SMK BAKNUS 666 di Lomba Kompetensi',
            'content' => 'Bangga dengan prestasi siswa-siswi SMK BAKNUS 666 yang berhasil meraih juara dalam berbagai lomba kompetensi:\n\n🏆 Juara 1 Lomba Programming Tingkat Provinsi - Andi Pratama (XII RPL)\n🏆 Juara 2 Lomba Desain Grafis - Sari Indah (XI MM)\n🏆 Juara 3 Lomba Networking - Tim SMK BAKNUS 666\n\nSelamat kepada para juara! Kalian adalah kebanggaan sekolah.',
            'author' => 'Wakasek Kesiswaan',
            'user_id' => 1,
            'category_id' => 1,
            'status' => 'published',
            'is_featured' => true,
            'published_at' => now()
        ]);

        Mading::create([
            'title' => 'Pengumuman Prakerin Gelombang 2',
            'content' => 'Pengumuman untuk siswa kelas XI semua jurusan:\n\nPraktik Kerja Industri (Prakerin) Gelombang 2 akan dimulai pada:\n📅 Tanggal: 15 Januari 2024\n⏰ Waktu: 07.00 WIB\n📍 Tempat: Sesuai penempatan masing-masing\n\nPersiapan yang harus dilakukan:\n✅ Surat pengantar dari sekolah\n✅ CV dan portofolio\n✅ Seragam prakerin\n✅ Buku jurnal prakerin\n\nInfo lebih lanjut hubungi Bapak Humas.',
            'author' => 'Koordinator Prakerin',
            'user_id' => 1,
            'category_id' => 5,
            'status' => 'published',
            'published_at' => now()
        ]);

        Mading::create([
            'title' => 'Tips Sukses Menghadapi Ujian Kompetensi Keahlian',
            'content' => 'Ujian Kompetensi Keahlian (UKK) sudah semakin dekat. Berikut tips sukses dari guru-guru SMK BAKNUS 666:\n\n💡 PERSIAPAN TEKNIS:\n- Pelajari kembali modul praktik\n- Latihan soal-soal tahun sebelumnya\n- Pastikan peralatan dalam kondisi baik\n\n💡 PERSIAPAN MENTAL:\n- Istirahat yang cukup\n- Berdoa dan berpikir positif\n- Percaya diri dengan kemampuan\n\n💡 SAAT UJIAN:\n- Baca instruksi dengan teliti\n- Kelola waktu dengan baik\n- Tetap tenang dan fokus\n\nSemangat untuk semua siswa kelas XII!',
            'author' => 'Tim Guru Produktif',
            'user_id' => 1,
            'category_id' => 4,
            'status' => 'published',
            'published_at' => now()
        ]);
    }
}
