<?php
$host = '127.0.0.1';
$dbname = 'mading_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create likes table
    $sql = "CREATE TABLE IF NOT EXISTS likes (
        id_like BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        id_artikel BIGINT UNSIGNED NOT NULL,
        id_user BIGINT UNSIGNED NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (id_artikel) REFERENCES madings(id) ON DELETE CASCADE,
        FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE,
        UNIQUE KEY unique_like (id_artikel, id_user)
    )";
    
    $pdo->exec($sql);
    echo "Tabel likes berhasil dibuat!";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>