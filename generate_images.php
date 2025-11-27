<?php
// Script untuk generate gambar placeholder
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

$width = 800;
$height = 400;

foreach ($images as $filename => $data) {
    $image = imagecreate($width, $height);
    
    // Convert hex color to RGB
    $hex = $data[1];
    $r = hexdec(substr($hex, 1, 2));
    $g = hexdec(substr($hex, 3, 2));
    $b = hexdec(substr($hex, 5, 2));
    
    $bg_color = imagecolorallocate($image, $r, $g, $b);
    $text_color = imagecolorallocate($image, 255, 255, 255);
    
    // Add text
    $text = $data[0];
    $font_size = 5;
    $text_width = imagefontwidth($font_size) * strlen($text);
    $text_height = imagefontheight($font_size);
    
    $x = ($width - $text_width) / 2;
    $y = ($height - $text_height) / 2;
    
    imagestring($image, $font_size, $x, $y, $text, $text_color);
    
    // Add SMK BAKNUS 666 logo text
    $logo_text = "SMK BAKNUS 666";
    $logo_width = imagefontwidth(3) * strlen($logo_text);
    $logo_x = ($width - $logo_width) / 2;
    $logo_y = $y + 40;
    
    imagestring($image, 3, $logo_x, $logo_y, $logo_text, $text_color);
    
    // Save image
    $filepath = "public/storage/mading-images/" . $filename;
    imagejpeg($image, $filepath, 90);
    imagedestroy($image);
    
    echo "Generated: " . $filename . "\n";
}

echo "All images generated successfully!\n";
?>