-- Setup Database E-Mading SMK
-- Jalankan script ini di phpMyAdmin atau MySQL client

-- 1. Buat database jika belum ada
CREATE DATABASE IF NOT EXISTS mading_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE mading_db;

-- 2. Update tabel users untuk menambah kolom role dan username
ALTER TABLE users 
ADD COLUMN role ENUM('admin', 'guru', 'siswa') DEFAULT 'siswa' AFTER password,
ADD COLUMN username VARCHAR(255) UNIQUE AFTER email;

-- 3. Update tabel madings untuk menambah kolom yang diperlukan
ALTER TABLE madings 
ADD COLUMN user_id BIGINT UNSIGNED DEFAULT 1 AFTER author,
ADD COLUMN category_id BIGINT UNSIGNED NULL AFTER user_id,
ADD COLUMN views INT DEFAULT 0 AFTER is_published,
ADD COLUMN is_featured BOOLEAN DEFAULT FALSE AFTER views,
ADD COLUMN status ENUM('draft', 'published', 'archived') DEFAULT 'published' AFTER is_featured,
ADD COLUMN excerpt TEXT NULL AFTER status,
ADD COLUMN attachments JSON NULL AFTER excerpt,
ADD COLUMN published_at TIMESTAMP NULL AFTER attachments;

-- 4. Update data existing di tabel madings
UPDATE madings SET 
    status = 'published',
    published_at = created_at
WHERE is_published = 1;

UPDATE madings SET 
    status = 'draft'
WHERE is_published = 0;

-- 5. Insert data admin default jika belum ada
INSERT IGNORE INTO users (name, email, username, password, role, created_at, updated_at) VALUES
('Admin Sekolah', 'admin@smk.sch.id', 'admin', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NOW(), NOW()),
('Guru Pembina', 'guru@smk.sch.id', 'guru1', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'guru', NOW(), NOW()),
('Siswa SMK', 'siswa@smk.sch.id', 'siswa1', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'siswa', NOW(), NOW());

-- Password untuk semua akun di atas adalah: password

-- 6. Insert data categories
INSERT IGNORE INTO categories (id, name, slug, description, created_at, updated_at) VALUES
(1, 'Prestasi', 'prestasi', 'Artikel tentang prestasi siswa dan sekolah', NOW(), NOW()),
(2, 'Opini', 'opini', 'Artikel opini dan pendapat', NOW(), NOW()),
(3, 'Kegiatan', 'kegiatan', 'Informasi kegiatan sekolah', NOW(), NOW()),
(4, 'Informasi Sekolah', 'informasi-sekolah', 'Informasi umum sekolah', NOW(), NOW()),
(5, 'Pengumuman', 'pengumuman', 'Pengumuman resmi sekolah', NOW(), NOW()),
(6, 'Berita', 'berita', 'Berita terkini sekolah', NOW(), NOW());

-- 7. Update existing madings dengan category_id random
UPDATE madings SET category_id = FLOOR(1 + RAND() * 6) WHERE category_id IS NULL;

-- 8. Tambahkan foreign key constraints
ALTER TABLE madings 
ADD CONSTRAINT madings_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
ADD CONSTRAINT madings_category_id_foreign FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL;

-- 9. Insert sample data untuk testing
INSERT INTO madings (title, content, author, user_id, category_id, status, is_featured, views, excerpt, published_at, created_at, updated_at) VALUES
('Selamat Datang di E-Mading Digital', 'Sistem E-Mading digital ini dirancang untuk memudahkan siswa, guru, dan admin dalam berbagi informasi sekolah. Dengan fitur yang lengkap dan mudah digunakan, diharapkan dapat meningkatkan komunikasi dan partisipasi seluruh warga sekolah.', 'Admin Sekolah', 1, 4, 'published', 1, 25, 'Pengenalan sistem E-Mading digital untuk sekolah', NOW(), NOW(), NOW()),
('Tips Menulis Artikel yang Menarik', 'Menulis artikel yang baik memerlukan persiapan dan teknik yang tepat. Berikut adalah beberapa tips untuk membuat artikel yang menarik dan informatif...', 'Guru Pembina', 2, 2, 'published', 0, 15, 'Panduan menulis artikel yang menarik untuk siswa', NOW(), NOW(), NOW()),
('Prestasi Siswa dalam Lomba Karya Tulis', 'Siswa SMK berhasil meraih juara dalam lomba karya tulis tingkat provinsi. Pencapaian ini membanggakan dan menunjukkan kualitas pendidikan di sekolah kita.', 'Siswa SMK', 3, 1, 'published', 1, 42, 'Pencapaian siswa dalam lomba karya tulis', NOW(), NOW(), NOW());

-- 10. Buat tabel notifications
CREATE TABLE IF NOT EXISTS notifications (
    id_notification BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_user BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    type ENUM('info', 'success', 'warning', 'danger') DEFAULT 'info',
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE
);

-- 11. Buat tabel likes
CREATE TABLE IF NOT EXISTS likes (
    id_like BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_artikel BIGINT UNSIGNED NOT NULL,
    id_user BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_artikel) REFERENCES madings(id) ON DELETE CASCADE,
    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_like (id_artikel, id_user)
);

-- 12. Insert sample notifications
INSERT INTO notifications (id_user, title, message, type, is_read) VALUES
(1, 'Selamat Datang', 'Selamat datang di sistem E-Mading digital!', 'success', 0),
(2, 'Artikel Baru', 'Ada artikel baru yang perlu direview', 'info', 0),
(3, 'Pengumuman', 'Jangan lupa submit artikel minggu ini', 'warning', 0);

-- 13. Verifikasi setup
SELECT 'Setup database berhasil!' as status;
SELECT COUNT(*) as total_users FROM users;
SELECT COUNT(*) as total_categories FROM categories;
SELECT COUNT(*) as total_madings FROM madings;
SELECT COUNT(*) as total_notifications FROM notifications;
SELECT COUNT(*) as total_likes FROM likes;