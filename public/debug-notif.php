<?php
$host = '127.0.0.1';
$dbname = 'mading_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Test insert notifikasi
    $stmt = $pdo->prepare("INSERT INTO notifications (id_user, title, message, type, is_read, created_at, updated_at) VALUES (?, ?, ?, 'info', 0, NOW(), NOW())");
    $result = $stmt->execute([1, 'Test Notifikasi', 'Test pesan notifikasi']);
    
    if ($result) {
        echo "Notifikasi berhasil dikirim!<br>";
        
        // Cek notifikasi yang ada
        $check = $pdo->query("SELECT * FROM notifications ORDER BY created_at DESC LIMIT 5");
        $notifications = $check->fetchAll();
        
        echo "<h3>5 Notifikasi Terakhir:</h3>";
        foreach($notifications as $notif) {
            echo "- {$notif['title']}: {$notif['message']}<br>";
        }
    } else {
        echo "Gagal mengirim notifikasi";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>