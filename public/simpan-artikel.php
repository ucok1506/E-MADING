<?php
try {
    $host = '127.0.0.1';
    $dbname = 'mading_db';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($_POST) {
        $judul = $_POST['judul'];
        $kategori = $_POST['kategori'];
        $isi = $_POST['isi'];
        $foto = null;
        
        // Validasi dan perbaiki kategori
        if (empty($kategori) || $kategori == 'null' || $kategori == '0') {
            // Cek apakah ada kategori di database
            $stmt = $pdo->query("SELECT id_kategori FROM kategori ORDER BY id_kategori LIMIT 1");
            $defaultKategori = $stmt->fetch();
            
            if (!$defaultKategori) {
                // Buat kategori default jika tidak ada
                $pdo->exec("INSERT INTO kategori (nama_kategori) VALUES ('Umum')");
                $kategori = $pdo->lastInsertId();
            } else {
                $kategori = $defaultKategori['id_kategori'];
            }
        } else {
            // Validasi kategori yang dipilih ada di database
            $stmt = $pdo->prepare("SELECT id_kategori FROM kategori WHERE id_kategori = ?");
            $stmt->execute([$kategori]);
            if (!$stmt->fetch()) {
                // Jika kategori tidak valid, gunakan kategori pertama
                $stmt = $pdo->query("SELECT id_kategori FROM kategori ORDER BY id_kategori LIMIT 1");
                $defaultKategori = $stmt->fetch();
                $kategori = $defaultKategori['id_kategori'];
            }
        }
        
        // Handle file upload
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $upload_dir = 'uploads/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            $file_extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $filename = time() . '.' . $file_extension;
            $foto = $filename;
            
            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $upload_dir . $filename)) {
                throw new Exception("Gagal mengupload file foto");
            }
        }
        
        // Debug: Pastikan kategori valid
        if (empty($kategori) || !is_numeric($kategori)) {
            throw new Exception("Kategori tidak valid: " . var_export($kategori, true));
        }
        
        // Insert artikel
        $stmt = $pdo->prepare("INSERT INTO artikel (judul, isi, foto, id_kategori, id_user, status, tanggal) VALUES (?, ?, ?, ?, 1, 'draft', NOW())");
        $stmt->execute([$judul, $isi, $foto, (int)$kategori]);
        
        echo "<script>alert('Artikel berhasil disimpan!'); window.location.href='/siswa/dashboard';</script>";
    }
    
} catch (Exception $e) {
    echo "<script>alert('Error: " . $e->getMessage() . "'); history.back();</script>";
}
?>