<?php
try {
    $host = '127.0.0.1';
    $dbname = 'mading_db';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create likes table
    $sql = "CREATE TABLE IF NOT EXISTS likes (
        id_like INT AUTO_INCREMENT PRIMARY KEY,
        id_artikel INT NOT NULL,
        id_user INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UNIQUE KEY unique_like (id_artikel, id_user)
    )";
    
    $pdo->exec($sql);
    echo "Tabel likes berhasil dibuat!";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>