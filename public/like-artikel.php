<?php
header('Content-Type: application/json');

try {
    $host = '127.0.0.1';
    $dbname = 'mading_db';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $artikel_id = $_POST['artikel_id'] ?? 0;
    $user_id = $_POST['user_id'] ?? 1; // Default user
    
    // Get current like count first
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM `like` WHERE id_artikel = ?");
    $stmt->execute([$artikel_id]);
    $current_total = $stmt->fetch()['total'];
    
    // Check if already liked
    $stmt = $pdo->prepare("SELECT * FROM `like` WHERE id_artikel = ? AND id_user = ?");
    $stmt->execute([$artikel_id, $user_id]);
    $existing = $stmt->fetch();
    
    if ($existing) {
        // Unlike
        $stmt = $pdo->prepare("DELETE FROM `like` WHERE id_artikel = ? AND id_user = ?");
        $stmt->execute([$artikel_id, $user_id]);
        $liked = false;
        $total = $current_total - 1;
    } else {
        // Like
        $stmt = $pdo->prepare("INSERT INTO `like` (id_artikel, id_user, created_at) VALUES (?, ?, NOW())");
        $stmt->execute([$artikel_id, $user_id]);
        $liked = true;
        $total = $current_total + 1;
    }
    
    echo json_encode(['success' => true, 'liked' => $liked, 'total' => $total]);
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>