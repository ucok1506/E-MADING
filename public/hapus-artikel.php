<?php
try {
    $host = '127.0.0.1';
    $dbname = 'mading_db';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if (isset($_POST['artikel_id'])) {
        $artikel_id = $_POST['artikel_id'];
        
        // Delete artikel
        $stmt = $pdo->prepare("DELETE FROM artikel WHERE id_artikel = ?");
        $stmt->execute([$artikel_id]);
        
        echo "Artikel berhasil dihapus!";
    } else {
        echo "ID artikel tidak valid!";
    }
    
} catch (Exception $e) {
    echo "Error: " . addslashes($e->getMessage());
}
?>