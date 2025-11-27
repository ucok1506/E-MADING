<?php
try {
    $host = '127.0.0.1';
    $dbname = 'mading_db';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Handle approve/reject
    if ($_POST) {
        $action = $_POST['action'] ?? '';
        $artikel_id = $_POST['artikel_id'] ?? '';
        
        if ($action === 'approve') {
            $stmt = $pdo->prepare("UPDATE artikel SET status = 'publish' WHERE id_artikel = ?");
            $stmt->execute([$artikel_id]);
            
            // Get artikel info
            $stmt = $pdo->prepare("SELECT * FROM artikel WHERE id_artikel = ?");
            $stmt->execute([$artikel_id]);
            $artikel = $stmt->fetch();
            
            // Buat notifikasi untuk penulis
            $stmt = $pdo->prepare("INSERT INTO notifications (id_user, judul, pesan, tanggal, is_read) VALUES (?, ?, ?, NOW(), 0)");
            $stmt->execute([
                $artikel['id_user'],
                'Artikel Disetujui',
                "Artikel '{$artikel['judul']}' telah disetujui dan dipublikasi"
            ]);
            
            echo "<script>alert('Artikel berhasil disetujui!'); setTimeout(function(){ window.location.reload(); }, 1000);</script>";
        }
        
        if ($action === 'reject') {
            $alasan = $_POST['alasan'] ?? 'Tidak sesuai kriteria';
            
            $stmt = $pdo->prepare("UPDATE artikel SET status = 'rejected' WHERE id_artikel = ?");
            $stmt->execute([$artikel_id]);
            
            // Get artikel info
            $stmt = $pdo->prepare("SELECT * FROM artikel WHERE id_artikel = ?");
            $stmt->execute([$artikel_id]);
            $artikel = $stmt->fetch();
            
            // Buat notifikasi untuk penulis
            $stmt = $pdo->prepare("INSERT INTO notifications (id_user, judul, pesan, tanggal, is_read) VALUES (?, ?, ?, NOW(), 0)");
            $stmt->execute([
                $artikel['id_user'],
                'Artikel Ditolak',
                "Artikel '{$artikel['judul']}' ditolak. Alasan: $alasan"
            ]);
            
            echo "<script>alert('Artikel berhasil ditolak!'); setTimeout(function(){ window.location.reload(); }, 1000);</script>";
        }
    }
    
    // Get pending articles
    $stmt = $pdo->prepare("SELECT * FROM artikel WHERE status = 'draft' ORDER BY tanggal DESC");
    $stmt->execute();
    $articles = $stmt->fetchAll();
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persetujuan Artikel - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Persetujuan Artikel</h2>
        
        <?php if (empty($articles)): ?>
            <div class="alert alert-info">Tidak ada artikel yang menunggu persetujuan.</div>
        <?php else: ?>
            <?php foreach ($articles as $article): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5><?= htmlspecialchars($article['judul'] ?? 'No Title') ?></h5>
                    <p><?= htmlspecialchars(substr($article['isi'] ?? '', 0, 200)) ?>...</p>
                    
                    <div class="mt-3">
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="action" value="approve">
                            <input type="hidden" name="artikel_id" value="<?= $article['id_artikel'] ?>">
                            <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                        </form>
                        
                        <form method="POST" class="d-inline ms-2">
                            <input type="hidden" name="action" value="reject">
                            <input type="hidden" name="artikel_id" value="<?= $article['id_artikel'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>