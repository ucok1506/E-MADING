<?php
$artikel_id = $_GET['id'] ?? 0;

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
        $alasan = $_POST['alasan'] ?? '';
        
        if ($action === 'approve') {
            // Get article author
            $stmt = $pdo->prepare("SELECT id_user, judul FROM artikel WHERE id_artikel = ?");
            $stmt->execute([$artikel_id]);
            $article_data = $stmt->fetch();
            
            // Update article status
            $stmt = $pdo->prepare("UPDATE artikel SET status = 'publish' WHERE id_artikel = ?");
            $stmt->execute([$artikel_id]);
            
            // Send notification to author
            $stmt = $pdo->prepare("INSERT INTO notifications (id_user, title, message, type, is_read, created_at) VALUES (?, ?, ?, 'success', 0, NOW())");
            $stmt->execute([
                $article_data['id_user'],
                'Artikel Disetujui',
                'Artikel "' . $article_data['judul'] . '" telah disetujui dan dipublikasikan!'
            ]);
            
            echo "<script>alert('Artikel berhasil disetujui dan notifikasi telah dikirim!'); window.location.href='/admin/dashboard';</script>";
        }
        
        if ($action === 'reject') {
            // Get article author
            $stmt = $pdo->prepare("SELECT id_user, judul FROM artikel WHERE id_artikel = ?");
            $stmt->execute([$artikel_id]);
            $article_data = $stmt->fetch();
            
            // Delete article instead of updating status
            $stmt = $pdo->prepare("DELETE FROM artikel WHERE id_artikel = ?");
            $stmt->execute([$artikel_id]);
            
            // Send notification to author
            $stmt = $pdo->prepare("INSERT INTO notifications (id_user, title, message, type, is_read, created_at) VALUES (?, ?, ?, 'warning', 0, NOW())");
            $stmt->execute([
                $article_data['id_user'],
                'Artikel Ditolak',
                'Artikel "' . $article_data['judul'] . '" telah ditolak dan dihapus oleh admin. Alasan: ' . $alasan
            ]);
            
            echo "<script>alert('Artikel berhasil ditolak dan dihapus!'); window.location.href='/admin/dashboard';</script>";
        }
    }
    
    // Get artikel
    $stmt = $pdo->prepare("SELECT * FROM artikel WHERE id_artikel = ?");
    $stmt->execute([$artikel_id]);
    $artikel = $stmt->fetch();
    
    if (!$artikel) {
        echo "<script>alert('Artikel tidak ditemukan!'); window.location.href='/admin-approval-simple.php';</script>";
        exit;
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Artikel - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Review Artikel</h5>
                        <a href="/admin-approval-simple.php" class="btn btn-secondary btn-sm">Kembali</a>
                    </div>
                    <div class="card-body">
                        <?php if ($artikel['foto']): ?>
                            <img src="/<?= $artikel['foto'] ?>" alt="Foto Artikel" class="img-fluid mb-3 rounded" style="max-height: 300px;">
                        <?php endif; ?>
                        
                        <h3><?= htmlspecialchars($artikel['judul']) ?></h3>
                        <p class="text-muted">Tanggal: <?= $artikel['tanggal'] ?></p>
                        
                        <div class="article-content">
                            <?= nl2br(htmlspecialchars($artikel['isi'])) ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Aksi Review</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="d-grid gap-2">
                                <button type="submit" name="action" value="approve" class="btn btn-success">
                                    <i class="fas fa-check"></i> Setujui Artikel
                                </button>
                                
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                                    <i class="fas fa-times"></i> Tolak Artikel
                                </button>
                            </div>
                        </form>
                        
                        <hr>
                        
                        <div class="info">
                            <h6>Informasi Artikel</h6>
                            <p><strong>Status:</strong> <span class="badge bg-warning"><?= ucfirst($artikel['status']) ?></span></p>
                            <p><strong>ID:</strong> <?= $artikel['id_artikel'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tolak -->
    <div class="modal fade" id="rejectModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tolak Artikel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Alasan Penolakan</label>
                            <textarea name="alasan" class="form-control" rows="3" placeholder="Berikan alasan mengapa artikel ini ditolak..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="action" value="reject" class="btn btn-danger">Tolak Artikel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>