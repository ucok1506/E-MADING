<?php
$images = [
    'robotika.jpg' => ['Prestasi Robotika', '#4CAF50'],
    'psb.jpg' => ['Penerimaan Siswa Baru', '#2196F3'],
    'workshop.jpg' => ['Workshop Digital Marketing', '#FF9800'],
    'kerjasama.jpg' => ['Kerjasama Industri', '#9C27B0'],
    'ujian.jpg' => ['Tips Ujian Praktik', '#F44336'],
    'hardiknas.jpg' => ['Hari Pendidikan Nasional', '#795548'],
    'beasiswa.jpg' => ['Program Beasiswa', '#607D8B'],
    'osn.jpg' => ['Olimpiade Sains Nasional', '#FFD700']
];

foreach ($images as $filename => $data) {
    $textColor = $data[1] === '#FFD700' ? '#333' : 'white';
    
    $svg = '<svg width="800" height="400" xmlns="http://www.w3.org/2000/svg">
  <rect width="800" height="400" fill="' . $data[1] . '"/>
  <text x="400" y="180" font-family="Arial" font-size="32" font-weight="bold" text-anchor="middle" fill="' . $textColor . '">' . $data[0] . '</text>
  <text x="400" y="220" font-family="Arial" font-size="20" text-anchor="middle" fill="' . $textColor . '">SMK BAKNUS 666</text>
</svg>';
    
    file_put_contents("public/storage/mading-images/" . $filename, $svg);
    echo "Created: " . $filename . "\n";
}

echo "All placeholder images created!\n";
?>