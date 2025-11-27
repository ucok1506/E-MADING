<?php
try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=mading_db", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h3>Test Users</h3>";
    
    $stmt = $pdo->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll();
    
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nama</th><th>Username</th><th>Role</th></tr>";
    foreach($users as $user) {
        echo "<tr>";
        echo "<td>" . $user['id_user'] . "</td>";
        echo "<td>" . $user['nama'] . "</td>";
        echo "<td>" . $user['username'] . "</td>";
        echo "<td>" . $user['role'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>