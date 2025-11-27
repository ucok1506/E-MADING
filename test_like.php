<?php
// Test file untuk memeriksa fungsi like
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Cek apakah tabel likes ada
try {
    $likes = DB::table('likes')->count();
    echo "Tabel likes exists. Total likes: " . $likes . "\n";
    
    $madings = DB::table('madings')->count();
    echo "Total madings: " . $madings . "\n";
    
    $users = DB::table('users')->count();
    echo "Total users: " . $users . "\n";
    
    // Cek struktur tabel likes
    $columns = DB::select("DESCRIBE likes");
    echo "\nStruktur tabel likes:\n";
    print_r($columns);
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
