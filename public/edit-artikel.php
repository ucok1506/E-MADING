<?php
$artikel_id = $_GET['id'] ?? 0;

try {
    $host = '127.0.0.1';
    $dbname = 'mading_db';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Handle update
    if ($_POST) {
        $judul = $_POST['judul'] ?? '';
        $kategori = $_POST['kategori'] ?? '';
        $isi = $_POST['isi'] ?? '';
        
        // Handle foto upload
        $foto_query = '';
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $file_extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $filename = time() . '.' . $file_extension;
            $foto = $filename; // Simpan hanya nama file
            move_uploaded_file($_FILES['foto']['tmp_name'], $uploadDir . $filename);
            $foto_query = ', foto = ?';
        }
        
        // Update artikel
        $sql = "UPDATE artikel SET judul = ?, isi = ?, id_kategori = ?, status = 'draft'" . $foto_query . " WHERE id_artikel = ?";
        $params = [$judul, $isi, $kategori];
        if ($foto_query) {
            $params[] = $foto;
        }
        $params[] = $artikel_id;
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        
        try {
            // Cek apakah artikel pernah ditolak
            $approvalStmt = $pdo->prepare("SELECT status FROM article_approvals WHERE id_artikel = ?");
            $approvalStmt->execute([$artikel_id]);
            $approval = $approvalStmt->fetch();
            $wasRejected = $approval && $approval['status'] === 'rejected';
            
            // Update status approval ke pending
            if ($approval) {
                $updateApproval = $pdo->prepare("UPDATE article_approvals SET status = 'pending', tanggal_submit = NOW(), alasan_penolakan = NULL, tanggal_review = NULL, id_admin = NULL WHERE id_artikel = ?");
                $updateApproval->execute([$artikel_id]);
            } else {
                $insertApproval = $pdo->prepare("INSERT INTO article_approvals (id_artikel, id_user, status, tanggal_submit) VALUES (?, 1, 'pending', NOW())");
                $insertApproval->execute([$artikel_id]);
            }
            
            // Kirim notifikasi ke admin
            $adminStmt = $pdo->prepare("SELECT id_user FROM users WHERE role = 'admin'");
            $adminStmt->execute();
            $admins = $adminStmt->fetchAll();
            
            if ($admins) {
                $title = $wasRejected ? 'Artikel Ditolak Telah Diedit' : 'Artikel Diperbarui';
                $message = $wasRejected 
                    ? "Siswa telah mengedit artikel yang ditolak '{$judul}' dan mengirim ulang untuk review"
                    : "Siswa memperbarui artikel '{$judul}' untuk direview ulang";
                    
                foreach ($admins as $admin) {
                    $notifStmt = $pdo->prepare("INSERT INTO notifications (id_user, title, message, type, is_read, created_at, updated_at) VALUES (?, ?, ?, 'info', 0, NOW(), NOW())");
                    $notifStmt->execute([$admin['id_user'], $title, $message]);
                }
            }
        } catch (Exception $e) {
            // Jika ada error notifikasi, tetap lanjutkan
            error_log("Error sending notification: " . $e->getMessage());
        }
        
        echo "<script>alert('Artikel berhasil diupdate!'); window.location.href='/siswa/dashboard';</script>";
    }
    
    // Get artikel data
    $stmt = $pdo->prepare("SELECT * FROM artikel WHERE id_artikel = ?");
    $stmt->execute([$artikel_id]);
    $artikel = $stmt->fetch();
    
    if (!$artikel) {
        echo "<script>alert('Artikel tidak ditemukan!'); window.location.href='/siswa/dashboard';</script>";
        exit;
    }
    
    // Get categories
    $stmt = $pdo->prepare("SELECT * FROM kategori");
    $stmt->execute();
    $categories = $stmt->fetchAll();
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Artikel</h2>
        
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Judul Artikel</label>
                <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($artikel['judul']) ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-select" required>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id_kategori'] ?>" <?= $cat['id_kategori'] == $artikel['id_kategori'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['nama_kategori']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Foto</label>
                <?php if ($artikel['foto']): ?>
                    <div class="mb-2">
                        <?php
                        $imagePath = null;
                        $paths = [
                            'uploads/' . $artikel['foto'],
                            'uploads/' . basename($artikel['foto']),
                            $artikel['foto']
                        ];
                        foreach($paths as $path) {
                            if(file_exists($path)) {
                                $imagePath = $path;
                                break;
                            }
                        }
                        ?>
                        <?php if ($imagePath): ?>
                            <img src="<?= $imagePath ?>" alt="Foto saat ini" style="max-width: 200px;" class="img-thumbnail">
                        <?php else: ?>
                            <div class="alert alert-warning">Foto tidak ditemukan: <?= $artikel['foto'] ?></div>
                        <?php endif; ?>
                        <p class="small text-muted">Foto saat ini</p>
                    </div>
                <?php endif; ?>
                <input type="file" name="foto" class="form-control" accept="image/*">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Isi Artikel</label>
                <textarea name="isi" class="form-control" rows="10" required><?= htmlspecialchars($artikel['isi']) ?></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Update Artikel</button>
            <a href="/admin/dashboard" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>