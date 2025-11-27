<?php
$images = [
    'robotika.jpg' => 'https://via.placeholder.com/800x400/4CAF50/FFFFFF?text=Prestasi+Robotika+SMK+BAKNUS+666',
    'psb.jpg' => 'https://via.placeholder.com/800x400/2196F3/FFFFFF?text=Penerimaan+Siswa+Baru+SMK+BAKNUS+666',
    'workshop.jpg' => 'https://via.placeholder.com/800x400/FF9800/FFFFFF?text=Workshop+Digital+Marketing+SMK+BAKNUS+666',
    'kerjasama.jpg' => 'https://via.placeholder.com/800x400/9C27B0/FFFFFF?text=Kerjasama+Industri+SMK+BAKNUS+666',
    'ujian.jpg' => 'https://via.placeholder.com/800x400/F44336/FFFFFF?text=Tips+Ujian+Praktik+SMK+BAKNUS+666',
    'hardiknas.jpg' => 'https://via.placeholder.com/800x400/795548/FFFFFF?text=Hari+Pendidikan+Nasional+SMK+BAKNUS+666',
    'beasiswa.jpg' => 'https://via.placeholder.com/800x400/607D8B/FFFFFF?text=Program+Beasiswa+SMK+BAKNUS+666',
    'osn.jpg' => 'https://via.placeholder.com/800x400/FFD700/333333?text=Olimpiade+Sains+Nasional+SMK+BAKNUS+666'
];

foreach ($images as $filename => $url) {
    $filepath = "public/storage/mading-images/" . $filename;
    
    $imageData = file_get_contents($url);
    if ($imageData !== false) {
        file_put_contents($filepath, $imageData);
        echo "Downloaded: " . $filename . "\n";
    } else {
        echo "Failed to download: " . $filename . "\n";
    }
}

echo "Image download completed!\n";
?>