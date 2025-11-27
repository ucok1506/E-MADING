<?php
echo "Test file works!";
echo "<br>";
echo "Current directory: " . __DIR__;
echo "<br>";
echo "Laravel app exists: " . (file_exists(__DIR__ . '/artisan') ? 'Yes' : 'No');
?>