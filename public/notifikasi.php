<?php
// Halaman notifikasi untuk siswa/guru
$user_id = $_GET['user_id'] ?? 1; // Default user ID

try {
    $host = '127.0.0.1';
    $dbname = 'mading_db';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Mark as read if requested
    if (isset($_POST['mark_read'])) {
        $notif_id = $_POST['notif_id'];
        $stmt = $pdo->prepare("UPDATE notifications SET is_read = 1 WHERE id_notification = ?");
        $stmt->execute([$notif_id]);
        
        // Redirect back to dashboard
        echo "<script>window.location.href = document.referrer || '/dashboard';</script>";
        exit;
    }
    
    // Get notifications (only unread ones)
    $stmt = $pdo->prepare("SELECT * FROM notifications WHERE id_user = ? AND is_read = 0 ORDER BY created_at DESC LIMIT 20");
    $stmt->execute([$user_id]);
    $notifications = $stmt->fetchAll();
    
    // Get unread count
    $stmt = $pdo->prepare("SELECT COUNT(*) as unread FROM notifications WHERE id_user = ? AND is_read = 0");
    $stmt->execute([$user_id]);
    $result = $stmt->fetch();
    $unread_count = $result ? $result['unread'] : 0;
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    $notifications = [];
    $unread_count = 0;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Notifikasi <span class="badge bg-danger"><?= $unread_count ?></span></h2>
            <a href="javascript:history.back()" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>
        
        <?php if (empty($notifications)): ?>
            <div class="alert alert-info">Tidak ada notifikasi.</div>
        <?php else: ?>
            <?php foreach ($notifications as $notif): ?>
            <div class="card mb-2 <?= $notif['is_read'] ? '' : 'border-primary' ?>">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6><?= htmlspecialchars($notif['title']) ?></h6>
                            <p class="mb-1"><?= htmlspecialchars($notif['message']) ?></p>
                            <small class="text-muted"><?= $notif['created_at'] ?? 'No date' ?></small>
                        </div>
                        <?php if (!$notif['is_read']): ?>
                        <div>
                            <form method="POST" class="d-inline">
                                <input type="hidden" name="mark_read" value="1">
                                <input type="hidden" name="notif_id" value="<?= $notif['id_notification'] ?>">
                                <button type="submit" class="btn btn-sm btn-outline-primary">Tandai Dibaca</button>
                            </form>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>