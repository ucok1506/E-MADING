<?php
// Test search functionality
try {
    $host = '127.0.0.1';
    $dbname = 'mading_db';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h3>Test Database Connection</h3>";
    
    // Test 1: Check if articles exist
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM artikel");
    $stmt->execute();
    $total = $stmt->fetch()['total'];
    echo "Total articles in database: " . $total . "<br>";
    
    // Test 2: Check published articles
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM artikel WHERE status = 'publish'");
    $stmt->execute();
    $published = $stmt->fetch()['total'];
    echo "Published articles: " . $published . "<br>";
    
    // Test 3: Show some articles
    $stmt = $pdo->prepare("SELECT judul, status FROM artikel LIMIT 5");
    $stmt->execute();
    $articles = $stmt->fetchAll();
    
    echo "<h4>Sample Articles:</h4>";
    foreach($articles as $article) {
        echo "- " . $article['judul'] . " (Status: " . $article['status'] . ")<br>";
    }
    
    // Test 4: Test search
    $search = 'test';
    $stmt = $pdo->prepare("SELECT judul FROM artikel WHERE status = 'publish' AND (judul LIKE ? OR isi LIKE ?) LIMIT 3");
    $stmt->execute(["%$search%", "%$search%"]);
    $results = $stmt->fetchAll();
    
    echo "<h4>Search results for 'test':</h4>";
    if(empty($results)) {
        echo "No results found<br>";
    } else {
        foreach($results as $result) {
            echo "- " . $result['judul'] . "<br>";
        }
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>