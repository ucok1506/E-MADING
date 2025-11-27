<?php
$user_id = $_GET['user_id'] ?? 1; // Default user ID

try {
    $host = '127.0.0.1';
    $dbname = 'mading_db';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Handle delete
    if (isset($_POST['delete'])) {
        $artikel_id = $_POST['artikel_id'];
        $stmt = $pdo->prepare("DELETE FROM artikel WHERE id_artikel = ? AND id_user = ?");
        $stmt->execute([$artikel_id, $user_id]);
        echo "<script>alert('Artikel berhasil dihapus!'); window.location.href='kelola-artikel.php?user_id=1';</script>";
    }
    
    // Get user articles - simplified query
    $stmt = $pdo->prepare("SELECT * FROM artikel WHERE id_user = ? ORDER BY tanggal DESC");
    $stmt->execute([$user_id]);
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
    <title>Kelola Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Artikel Saya</h2>
            <a href="buat-artikel.php" class="btn btn-primary">Buat Artikel Baru</a>
        </div>
        
        <?php if (empty($articles)): ?>
            <div class="alert alert-info">Anda belum memiliki artikel.</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Like</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($articles as $article): ?>
                        <tr>
                            <td>
                                <?php if (isset($article['foto']) && $article['foto']): ?>
                                    <img src="/uploads/<?= basename($article['foto']) ?>" alt="Foto" style="width: 50px; height: 50px; object-fit: cover;" class="rounded" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="bg-light rounded align-items-center justify-content-center" style="width: 50px; height: 50px; display: none;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                <?php else: ?>
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($article['title'] ?? $article['judul'] ?? 'No Title') ?></td>
                            <td>Kategori <?= $article['id_kategori'] ?? 'N/A' ?></td>
                            <td>
                                <button class="btn btn-sm btn-outline-danger like-btn" data-artikel="<?= $article['id_artikel'] ?>">
                                    <i class="fas fa-heart"></i> <span class="like-count">0</span>
                                </button>
                            </td>
                            <td>
                                <?php if ($article['status'] === 'publish'): ?>
                                    <span class="badge bg-success">Published</span>
                                <?php elseif ($article['status'] === 'draft'): ?>
                                    <span class="badge bg-warning">Pending</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Rejected</span>
                                <?php endif; ?>
                            </td>
                            <td><?= date('d M Y', strtotime($article['tanggal'])) ?></td>
                            <td>
                                <a href="edit-artikel.php?id=<?= $article['id_artikel'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="delete" value="1">
                                    <input type="hidden" name="artikel_id" value="<?= $article['id_artikel'] ?>">
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus artikel ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
        
        <div class="mt-4">
            <a href="javascript:history.back()" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
    
    <script>
        document.querySelectorAll('.like-btn').forEach(btn => {
            // Load initial like count
            const artikelId = btn.dataset.artikel;
            fetch('/like-artikel.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `artikel_id=${artikelId}&user_id=1&action=count`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    btn.querySelector('.like-count').textContent = data.total;
                }
            });
            
            btn.addEventListener('click', function() {
                fetch('/like-artikel.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: `artikel_id=${artikelId}&user_id=1`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.querySelector('.like-count').textContent = data.total;
                        if (data.liked) {
                            this.classList.remove('btn-outline-danger');
                            this.classList.add('btn-danger');
                        } else {
                            this.classList.remove('btn-danger');
                            this.classList.add('btn-outline-danger');
                        }
                    } else {
                        alert('Error: ' + (data.error || 'Gagal like artikel'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat like artikel');
                });
            });
        });
    </script>
</body>
</html>