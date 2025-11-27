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
            echo "<script>alert('Artikel berhasil disetujui!'); window.location.href='admin-approval-simple.php';</script>";
        }
        
        if ($action === 'reject') {
            $stmt = $pdo->prepare("UPDATE artikel SET status = 'rejected' WHERE id_artikel = ?");
            $stmt->execute([$artikel_id]);
            echo "<script>alert('Artikel berhasil ditolak!'); window.location.href='admin-approval-simple.php';</script>";
        }
    }
    
    // Get pending articles
    $stmt = $pdo->prepare("SELECT id_artikel, judul, isi FROM artikel WHERE status = 'draft'");
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
                    <h5><?= htmlspecialchars($article['judul']) ?></h5>
                    <p><?= htmlspecialchars(substr($article['isi'], 0, 200)) ?>...</p>
                    
                    <div class="mt-3">
                        <a href="/review-artikel.php?id=<?= $article['id_artikel'] ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-eye"></i> Review Artikel
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>