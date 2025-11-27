<?php

namespace Database\Seeders;

use App\Models\Mading;
use Illuminate\Database\Seeder;

class DetailedMadingSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Prestasi Gemilang Siswa SMK BAKNUS 666 di Lomba Robotika Nasional',
                'content' => 'Tim robotika SMK BAKNUS 666 berhasil meraih juara 1 dalam Kompetisi Robotika Nasional 2024. Tim yang terdiri dari 5 siswa jurusan Teknik Elektronika ini berhasil mengalahkan 150 tim dari seluruh Indonesia.

Kompetisi yang berlangsung selama 3 hari di Jakarta Convention Center ini menguji kemampuan siswa dalam merancang, membangun, dan memprogram robot untuk menyelesaikan berbagai tantangan.

"Kami sangat bangga dengan prestasi yang diraih. Ini adalah hasil kerja keras dan dedikasi siswa-siswa terbaik kami," ujar Kepala Sekolah SMK BAKNUS 666.

Robot yang dibuat tim SMK BAKNUS 666 mampu menyelesaikan semua tantangan dengan waktu tercepat dan akurasi tertinggi. Tim juga mendapat apresiasi khusus untuk inovasi dalam desain robot mereka.',
                'author' => 'Drs. Ahmad Wijaya, M.Pd',
                'category' => 'prestasi',
                'is_featured' => true,
                'is_published' => true,
                'views' => 245,
                'image' => null
            ],
            [
                'title' => 'Pengumuman Penerimaan Siswa Baru Tahun Ajaran 2024/2025',
                'content' => 'SMK BAKNUS 666 membuka pendaftaran siswa baru untuk tahun ajaran 2024/2025. Tersedia 5 jurusan unggulan:

1. Pengembangan Perangkat Lunak dan Gim (PPLG)
2. Akuntansi dan Keuangan Lembaga (AKT)
3. Desain Komunikasi Visual (DKV)
4. Animasi (ANIMASI)
5. Pemasaran (PEMASARAN)

Syarat Pendaftaran:
- Lulusan SMP/MTs sederajat
- Fotokopi ijazah dan SKHUN
- Pas foto 3x4 sebanyak 4 lembar
- Fotokopi KK dan KTP orang tua

Pendaftaran dibuka mulai 1 Januari hingga 31 Maret 2024. Biaya pendaftaran Rp 100.000.

Informasi lebih lanjut dapat menghubungi panitia PSB di nomor (022) 123-4567 atau datang langsung ke sekolah.',
                'author' => 'Panitia PSB',
                'category' => 'pengumuman',
                'is_featured' => true,
                'is_published' => true,
                'views' => 189,
                'image' => null
            ],
            [
                'title' => 'Workshop Digital Marketing untuk Siswa Jurusan Multimedia',
                'content' => 'Jurusan Multimedia SMK BAKNUS 666 mengadakan workshop Digital Marketing yang diikuti oleh 60 siswa kelas XI dan XII. Workshop ini menghadirkan praktisi digital marketing terkemuka dari Jakarta.

Materi yang disampaikan meliputi:
- Strategi Social Media Marketing
- Content Creation untuk Brand
- Google Ads dan Facebook Ads
- Analisis Data Marketing
- E-commerce Management

"Workshop ini sangat bermanfaat untuk mempersiapkan siswa menghadapi dunia kerja yang semakin digital," kata Ibu Sari Dewi, Ketua Jurusan Multimedia.

Para siswa juga mendapat kesempatan praktik langsung membuat campaign digital marketing untuk produk UMKM lokal. Hasil terbaik akan mendapat hadiah dan kesempatan magang di perusahaan digital marketing.',
                'author' => 'Sari Dewi, S.Kom',
                'category' => 'kegiatan',
                'is_featured' => false,
                'is_published' => true,
                'views' => 156,
                'image' => null
            ],
            [
                'title' => 'Kerjasama SMK BAKNUS 666 dengan PT. Teknologi Maju Indonesia',
                'content' => 'SMK BAKNUS 666 menandatangani MoU kerjasama dengan PT. Teknologi Maju Indonesia dalam bidang pengembangan SDM dan penyerapan lulusan.

Kerjasama ini meliputi:
- Program magang untuk siswa kelas XII
- Pelatihan guru dengan teknologi terbaru
- Bantuan peralatan laboratorium
- Jaminan penyerapan lulusan terbaik

CEO PT. Teknologi Maju Indonesia, Bapak Rudi Hartono, menyatakan bahwa SMK BAKNUS 666 memiliki kualitas lulusan yang sangat baik dan sesuai dengan kebutuhan industri.

"Kami berkomitmen untuk terus mendukung pendidikan vokasi di Indonesia, khususnya SMK BAKNUS 666 yang telah terbukti menghasilkan lulusan berkualitas," ujarnya.

Penandatanganan MoU ini dihadiri oleh Kepala Dinas Pendidikan Kabupaten dan perwakilan dari Kamar Dagang dan Industri setempat.',
                'author' => 'Humas SMK BAKNUS 666',
                'category' => 'berita',
                'is_featured' => false,
                'is_published' => true,
                'views' => 134,
                'image' => null
            ],
            [
                'title' => 'Tips Sukses Menghadapi Ujian Praktik Kejuruan',
                'content' => 'Ujian Praktik Kejuruan (UPK) merupakan salah satu ujian penting bagi siswa SMK. Berikut tips sukses menghadapi UPK:

1. Persiapan Matang
   - Pelajari semua materi praktik yang telah diajarkan
   - Latihan berulang-ulang hingga mahir
   - Siapkan mental dan fisik yang prima

2. Pahami Instruksi dengan Baik
   - Baca soal dengan teliti
   - Tanyakan jika ada yang kurang jelas
   - Rencanakan langkah kerja sebelum memulai

3. Manajemen Waktu
   - Bagi waktu untuk setiap tahapan
   - Jangan terlalu lama di satu bagian
   - Sisakan waktu untuk pengecekan

4. Tetap Tenang dan Fokus
   - Jangan panik jika menghadapi kesulitan
   - Fokus pada pekerjaan yang sedang dikerjakan
   - Percaya pada kemampuan diri sendiri

Semoga tips ini bermanfaat untuk semua siswa yang akan menghadapi UPK. Selamat berjuang!',
                'author' => 'Tim Guru SMK BAKNUS 666',
                'category' => 'artikel',
                'is_featured' => false,
                'is_published' => true,
                'views' => 98,
                'image' => null
            ],
            [
                'title' => 'Peringatan Hari Pendidikan Nasional 2024',
                'content' => 'SMK BAKNUS 666 memperingati Hari Pendidikan Nasional dengan berbagai kegiatan menarik:

Upacara Bendera
Dilaksanakan pukul 07.00 WIB di lapangan sekolah dengan pembina upacara Kepala Sekolah.

Lomba Kreativitas Siswa
- Lomba poster pendidikan
- Lomba puisi
- Lomba video kreatif
- Lomba karya tulis ilmiah

Pameran Karya Siswa
Menampilkan hasil karya terbaik dari semua jurusan, mulai dari aplikasi mobile, website, produk elektronika, hingga karya multimedia.

Seminar Motivasi
Menghadirkan alumni sukses yang kini bekerja di perusahaan ternama untuk berbagi pengalaman dan memotivasi adik-adik kelasnya.

Kegiatan ini bertujuan untuk meningkatkan semangat belajar dan rasa cinta terhadap pendidikan di kalangan siswa SMK BAKNUS 666.',
                'author' => 'OSIS SMK BAKNUS 666',
                'category' => 'kegiatan',
                'is_featured' => false,
                'is_published' => true,
                'views' => 167,
                'image' => null
            ],
            [
                'title' => 'Informasi Beasiswa Prestasi untuk Siswa Berprestasi',
                'content' => 'SMK BAKNUS 666 menyediakan program beasiswa prestasi untuk siswa yang memiliki prestasi akademik dan non-akademik yang outstanding.

Jenis Beasiswa:
1. Beasiswa Prestasi Akademik
   - Untuk siswa dengan ranking 1-3 di kelasnya
   - Bebas SPP selama 1 semester
   - Mendapat bantuan buku dan seragam

2. Beasiswa Prestasi Non-Akademik
   - Untuk siswa yang berprestasi di bidang olahraga, seni, atau kompetisi
   - Bantuan biaya kegiatan ekstrakurikuler
   - Prioritas mengikuti kompetisi

3. Beasiswa Kurang Mampu
   - Untuk siswa dari keluarga kurang mampu
   - Berdasarkan survey ekonomi keluarga
   - Bantuan SPP dan kebutuhan sekolah

Persyaratan:
- Siswa aktif SMK BAKNUS 666
- Tidak pernah melanggar tata tertib sekolah
- Mengisi formulir pendaftaran
- Melampirkan dokumen pendukung

Pendaftaran dibuka setiap awal semester. Info lengkap di bagian kesiswaan.',
                'author' => 'Bagian Kesiswaan',
                'category' => 'informasi',
                'is_featured' => false,
                'is_published' => true,
                'views' => 203,
                'image' => null
            ],
            [
                'title' => 'Siswa SMK BAKNUS 666 Raih Medali Emas di Olimpiade Sains Nasional',
                'content' => 'Kebanggaan kembali ditorehkan siswa SMK BAKNUS 666. Andi Pratama, siswa kelas XI Teknik Elektronika, berhasil meraih medali emas dalam Olimpiade Sains Nasional (OSN) bidang Fisika.

Kompetisi yang diselenggarakan di Surabaya ini diikuti oleh 500 siswa terbaik dari seluruh Indonesia. Andi berhasil mengalahkan pesaing-pesaingnya dengan skor sempurna dalam babak final.

"Saya sangat senang bisa mengharumkan nama sekolah. Ini semua berkat dukungan guru-guru dan fasilitas laboratorium yang lengkap di sekolah," ujar Andi.

Prestasi ini menambah koleksi penghargaan SMK BAKNUS 666 yang sudah meraih berbagai prestasi di tingkat nasional. Sekolah berkomitmen terus mendukung siswa-siswa berprestasi untuk mengikuti berbagai kompetisi.

Sebagai apresiasi, Andi mendapat beasiswa penuh dan kesempatan untuk mengikuti program pertukaran pelajar ke Singapura.',
                'author' => 'Redaksi E-Mading',
                'category' => 'prestasi',
                'is_featured' => true,
                'is_published' => true,
                'views' => 312,
                'image' => null
            ]
        ];

        // Add articles without clearing existing ones
        
        foreach ($articles as $article) {
            $article['user_id'] = 1; // Admin user
            $article['category_id'] = 1; // Default category
            $article['status'] = 'published';
            Mading::create($article);
        }
        
        // Add more sample articles
        $moreArticles = [
            [
                'title' => 'Juara 1 Lomba Web Design Tingkat Provinsi',
                'content' => 'Tim Web Design SMK BAKNUS 666 meraih juara 1 dalam Lomba Web Design tingkat Provinsi Jawa Barat. Kompetisi yang diikuti 50 sekolah ini menguji kreativitas dan kemampuan teknis siswa dalam membuat website yang menarik dan fungsional.',
                'author' => 'Rina Sari, S.Kom',
                'category' => 'prestasi',
                'is_featured' => true,
                'is_published' => true,
                'views' => 187,
                'image' => null
            ],
            [
                'title' => 'Pelatihan Coding Bootcamp untuk Siswa PPLG',
                'content' => 'Jurusan PPLG (Pengembangan Perangkat Lunak dan Gim) mengadakan coding bootcamp selama 3 hari dengan materi HTML, CSS, JavaScript, PHP, dan Unity. Pelatihan ini bertujuan meningkatkan skill programming dan game development siswa untuk persiapan dunia kerja.',
                'author' => 'Budi Santoso, M.T',
                'category' => 'kegiatan',
                'is_featured' => false,
                'is_published' => true,
                'views' => 143,
                'image' => null
            ],
            [
                'title' => 'Pengumuman Libur Semester Ganjil 2024',
                'content' => 'Libur semester ganjil akan dimulai tanggal 25 Desember 2024 hingga 8 Januari 2025. Siswa diharapkan memanfaatkan waktu libur untuk belajar mandiri dan mempersiapkan semester genap.',
                'author' => 'Tata Usaha',
                'category' => 'pengumuman',
                'is_featured' => false,
                'is_published' => true,
                'views' => 298,
                'image' => null
            ],
            [
                'title' => 'Tips Memilih Jurusan yang Tepat di SMK',
                'content' => 'Memilih jurusan di SMK adalah keputusan penting. Pertimbangkan minat, bakat, dan prospek karir. SMK BAKNUS 666 menyediakan 5 jurusan unggulan dengan fasilitas lengkap dan guru berpengalaman.',
                'author' => 'Konselor Sekolah',
                'category' => 'artikel',
                'is_featured' => false,
                'is_published' => true,
                'views' => 165,
                'image' => null
            ],
            [
                'title' => 'Kunjungan Industri ke PT. Telkom Indonesia',
                'content' => 'Siswa kelas XI PPLG berkunjung ke PT. Telkom Indonesia untuk melihat langsung penerapan teknologi software development di dunia industri. Kunjungan ini memberikan wawasan praktis tentang dunia kerja dan teknologi terkini.',
                'author' => 'Koordinator Kunjungan Industri',
                'category' => 'kegiatan',
                'is_featured' => false,
                'is_published' => true,
                'views' => 176,
                'image' => null
            ]
        ];
        
        foreach ($moreArticles as $article) {
            $article['user_id'] = 1;
            $article['category_id'] = 1;
            $article['status'] = 'published';
            Mading::create($article);
        }
        
        // Artikel khusus jurusan baru
        $jurusanArticles = [
            [
                'title' => 'Siswa DKV Raih Juara Desain Poster Anti Narkoba',
                'content' => 'Tim Desain Komunikasi Visual SMK BAKNUS 666 berhasil meraih juara 1 dalam lomba desain poster anti narkoba tingkat kota. Karya mereka dinilai sangat kreatif dan komunikatif dalam menyampaikan pesan anti narkoba kepada remaja.',
                'author' => 'Guru DKV',
                'category' => 'prestasi',
                'is_featured' => false,
                'is_published' => true,
                'views' => 89,
                'image' => null
            ],
            [
                'title' => 'Workshop Animasi 2D dan 3D untuk Jurusan Animasi',
                'content' => 'Jurusan Animasi mengadakan workshop intensif animasi 2D menggunakan Adobe Animate dan animasi 3D dengan Blender. Workshop ini menghadirkan animator profesional dari studio animasi ternama untuk berbagi pengalaman dan teknik terbaru.',
                'author' => 'Koordinator Animasi',
                'category' => 'kegiatan',
                'is_featured' => false,
                'is_published' => true,
                'views' => 124,
                'image' => null
            ],
            [
                'title' => 'Praktik Kerja Lapangan Jurusan AKT di Bank Mandiri',
                'content' => 'Siswa jurusan Akuntansi dan Keuangan Lembaga (AKT) melaksanakan PKL di Bank Mandiri cabang Bandung. Mereka mendapat pengalaman langsung dalam bidang perbankan, akuntansi, dan pelayanan nasabah.',
                'author' => 'Pembimbing PKL AKT',
                'category' => 'kegiatan',
                'is_featured' => false,
                'is_published' => true,
                'views' => 156,
                'image' => null
            ],
            [
                'title' => 'Strategi Digital Marketing Modern untuk Jurusan Pemasaran',
                'content' => 'Jurusan Pemasaran mengadakan seminar tentang strategi digital marketing di era modern. Materi mencakup social media marketing, content marketing, SEO, dan e-commerce. Siswa juga praktik langsung membuat campaign digital.',
                'author' => 'Dosen Tamu Pemasaran',
                'category' => 'kegiatan',
                'is_featured' => false,
                'is_published' => true,
                'views' => 198,
                'image' => null
            ],
            [
                'title' => 'Game Development Competition Jurusan PPLG',
                'content' => 'Siswa PPLG mengikuti kompetisi pengembangan game tingkat nasional. Tim SMK BAKNUS 666 berhasil masuk 10 besar dengan game edukatif tentang sejarah Indonesia yang dibuat menggunakan Unity dan C#.',
                'author' => 'Pembina PPLG',
                'category' => 'prestasi',
                'is_featured' => true,
                'is_published' => true,
                'views' => 267,
                'image' => null
            ]
        ];
        
        foreach ($jurusanArticles as $article) {
            $article['user_id'] = 1;
            $article['category_id'] = 1;
            $article['status'] = 'published';
            Mading::create($article);
        }
    }
}