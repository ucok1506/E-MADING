<?php
$search = $_POST['search'] ?? '';

try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=mading_db", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if (!empty($search)) {
        $stmt = $pdo->prepare("SELECT * FROM artikel WHERE status = 'publish' AND (judul LIKE ? OR isi LIKE ?) ORDER BY tanggal DESC LIMIT 6");
        $stmt->execute(["%$search%", "%$search%"]);
    } else {
        $stmt = $pdo->prepare("SELECT * FROM artikel WHERE status = 'publish' ORDER BY tanggal DESC LIMIT 6");
        $stmt->execute();
    }
    
    $articles = $stmt->fetchAll();
    
    if (empty($articles)) {
        echo '<div class="col-12 text-center"><p class="text-muted">Tidak ada artikel yang ditemukan.</p></div>';
    } else {
        foreach ($articles as $article) {
            echo '<div class="col-md-4 mb-4">';
            echo '<div class="card h-100">';
            if ($article['foto']) {
                echo '<img src="/' . $article['foto'] . '" class="card-img-top" style="height: 200px; object-fit: cover;">';
            }
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . htmlspecialchars($article['judul']) . '</h5>';
            echo '<p class="card-text">' . htmlspecialchars(substr(strip_tags($article['isi']), 0, 100)) . '...</p>';
            echo '<div class="d-flex justify-content-between align-items-center">';
            echo '<small class="text-muted">' . date('d M Y', strtotime($article['tanggal'])) . '</small>';
            echo '<span class="badge bg-primary">Artikel</span>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }
    
} catch (Exception $e) {
    echo '<div class="col-12 text-center"><p class="text-danger">Error: ' . $e->getMessage() . '</p></div>';
}
?>