<?php
try {
    $host = '127.0.0.1';
    $dbname = 'mading_db';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check table structure
    $stmt = $pdo->prepare("DESCRIBE artikel");
    $stmt->execute();
    $columns = $stmt->fetchAll();
    
    echo "<h3>Struktur Tabel Artikel:</h3>";
    foreach ($columns as $col) {
        echo $col['Field'] . " - " . $col['Type'] . "<br>";
    }
    
    // Check data
    $stmt = $pdo->prepare("SELECT * FROM artikel LIMIT 5");
    $stmt->execute();
    $data = $stmt->fetchAll();
    
    echo "<h3>Sample Data:</h3>";
    if ($data) {
        echo "<pre>";
        print_r($data[0]);
        echo "</pre>";
    } else {
        echo "No data found";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>