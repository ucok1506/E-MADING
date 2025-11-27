<?php
try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=mading_db", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->query("SELECT id_artikel, judul, foto FROM artikel WHERE foto IS NOT NULL AND foto != ''");
    $articles = $stmt->fetchAll();
    
    echo "<h3>Debug Gambar Artikel</h3>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Judul</th><th>Nama File</th><th>File Exists?</th><th>Preview</th></tr>";
    
    foreach($articles as $article) {
        $foto = $article['foto'];
        $paths = [
            'uploads/' . $foto,
            'uploads/' . basename($foto),
            $foto
        ];
        
        $exists = false;
        $workingPath = null;
        foreach($paths as $path) {
            if(file_exists($path)) {
                $exists = true;
                $workingPath = $path;
                break;
            }
        }
        
        echo "<tr>";
        echo "<td>" . $article['id_artikel'] . "</td>";
        echo "<td>" . htmlspecialchars($article['judul']) . "</td>";
        echo "<td>" . htmlspecialchars($foto) . "</td>";
        echo "<td>" . ($exists ? "YES ($workingPath)" : "NO") . "</td>";
        echo "<td>";
        if($exists) {
            echo "<img src='/$workingPath' style='width:50px;height:50px;object-fit:cover;'>";
        } else {
            echo "No image";
        }
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>