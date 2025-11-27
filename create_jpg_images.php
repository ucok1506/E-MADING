<?php
// Enable GD extension first
if (!extension_loaded('gd')) {
    die('GD extension is not loaded');
}

$images = [
    'robotika.jpg' => ['Prestasi Robotika', [76, 175, 80]], // #4CAF50
    'psb.jpg' => ['Penerimaan Siswa Baru', [33, 150, 243]], // #2196F3
    'workshop.jpg' => ['Workshop Digital Marketing', [255, 152, 0]], // #FF9800
    'kerjasama.jpg' => ['Kerjasama Industri', [156, 39, 176]], // #9C27B0
    'ujian.jpg' => ['Tips Ujian Praktik', [244, 67, 54]], // #F44336
    'hardiknas.jpg' => ['Hari Pendidikan Nasional', [121, 85, 72]], // #795548
    'beasiswa.jpg' => ['Program Beasiswa', [96, 125, 139]], // #607D8B
    'osn.jpg' => ['Olimpiade Sains Nasional', [255, 215, 0]] // #FFD700
];

$width = 800;
$height = 400;

foreach ($images as $filename => $data) {
    $image = imagecreate($width, $height);
    
    $bg_color = imagecolorallocate($image, $data[1][0], $data[1][1], $data[1][2]);
    $text_color = imagecolorallocate($image, 255, 255, 255);
    
    // For gold color, use dark text
    if ($filename === 'osn.jpg') {
        $text_color = imagecolorallocate($image, 51, 51, 51);
    }
    
    // Add main text
    $text = $data[0];
    $font_size = 5;
    $text_width = imagefontwidth($font_size) * strlen($text);
    $text_height = imagefontheight($font_size);
    
    $x = ($width - $text_width) / 2;
    $y = ($height - $text_height) / 2 - 20;
    
    imagestring($image, $font_size, $x, $y, $text, $text_color);
    
    // Add school name
    $logo_text = "SMK BAKNUS 666";
    $logo_width = imagefontwidth(3) * strlen($logo_text);
    $logo_x = ($width - $logo_width) / 2;
    $logo_y = $y + 40;
    
    imagestring($image, 3, $logo_x, $logo_y, $logo_text, $text_color);
    
    // Save as JPG
    $filepath = "public/storage/mading-images/" . $filename;
    imagejpeg($image, $filepath, 90);
    imagedestroy($image);
    
    echo "Generated JPG: " . $filename . "\n";
}

echo "All JPG images generated successfully!\n";
?>