<?php
// Halaman approval untuk admin
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
            // Update status artikel
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
            
            echo "<script>alert('Artikel berhasil disetujui!'); window.location.reload();</script>";
        }
        
        if ($action === 'reject') {
            $alasan = $_POST['alasan'] ?? 'Tidak sesuai kriteria';
            
            // Get artikel info
            $stmt = $pdo->prepare("SELECT * FROM artikel WHERE id_artikel = ?");
            $stmt->execute([$artikel_id]);
            $artikel = $stmt->fetch();
            
            // Update status artikel
            $stmt = $pdo->prepare("UPDATE artikel SET status = 'rejected' WHERE id_artikel = ?");
            $stmt->execute([$artikel_id]);
            
            // Buat notifikasi untuk penulis
            $stmt = $pdo->prepare("INSERT INTO notifications (id_user, judul, pesan, tanggal, is_read) VALUES (?, ?, ?, NOW(), 0)");
            $stmt->execute([
                $artikel['id_user'],
                'Artikel Ditolak',
                "Artikel '{$artikel['judul']}' ditolak. Alasan: $alasan"
            ]);
            
            echo "<script>alert('Artikel berhasil ditolak!'); window.location.reload();</script>";
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
                    <h5><?= htmlspecialchars($article['judul'] ?? 'Judul tidak tersedia') ?></h5>
                    <p class="text-muted">Artikel ID: <?= $article['id_artikel'] ?></p>
                    <p><?= htmlspecialchars(substr($article['isi'] ?? '', 0, 200)) ?>...</p>
                    <small class="text-muted">Tanggal: <?= $article['tanggal'] ?></small>
                    
                    <div class="mt-3">
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="action" value="approve">
                            <input type="hidden" name="artikel_id" value="<?= $article['id_artikel'] ?>">
                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Setujui artikel ini?')">
                                Setujui
                            </button>
                        </form>
                        
                        <button class="btn btn-danger btn-sm" onclick="showRejectForm(<?= $article['id_artikel'] ?>)">
                            Tolak
                        </button>
                        
                        <div id="reject-form-<?= $article['id_artikel'] ?>" style="display:none;" class="mt-2">
                            <form method="POST">
                                <input type="hidden" name="action" value="reject">
                                <input type="hidden" name="artikel_id" value="<?= $article['id_artikel'] ?>">
                                <div class="mb-2">
                                    <textarea name="alasan" class="form-control" placeholder="Alasan penolakan" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-danger btn-sm">Tolak Artikel</button>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="hideRejectForm(<?= $article['id_artikel'] ?>)">Batal</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <script>
        function showRejectForm(id) {
            document.getElementById('reject-form-' + id).style.display = 'block';
        }
        
        function hideRejectForm(id) {
            document.getElementById('reject-form-' + id).style.display = 'none';
        }
    </script>
</body>
</html>