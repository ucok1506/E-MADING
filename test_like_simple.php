<?php
require_once 'vendor/autoload.php';

// Load Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Test database connection
try {
    $pdo = new PDO('mysql:host=localhost;dbname=mading_db', 'root', '');
    echo "✓ Database connection OK\n";
    
    // Check if likes table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'likes'");
    if ($stmt->rowCount() > 0) {
        echo "✓ Table 'likes' exists\n";
        
        // Check table structure
        $stmt = $pdo->query("DESCRIBE likes");
        echo "✓ Table structure:\n";
        while ($row = $stmt->fetch()) {
            echo "  - {$row['Field']} ({$row['Type']})\n";
        }
    } else {
        echo "✗ Table 'likes' does not exist\n";
    }
    
    // Check if madings table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'madings'");
    if ($stmt->rowCount() > 0) {
        echo "✓ Table 'madings' exists\n";
        
        // Count articles
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM madings");
        $count = $stmt->fetch()['count'];
        echo "✓ Total articles: $count\n";
    } else {
        echo "✗ Table 'madings' does not exist\n";
    }
    
} catch (Exception $e) {
    echo "✗ Database error: " . $e->getMessage() . "\n";
}
?>