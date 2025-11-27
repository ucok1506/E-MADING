<?php
// Simple create form without Laravel
?>
<!DOCTYPE html>
<html>
<head>
    <title>Buat Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Buat Artikel Baru</h2>
        <form method="POST" action="store.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Judul</label>
                <input type="text" class="form-control" name="title" required>
            </div>
            <div class="mb-3">
                <label>Konten</label>
                <textarea class="form-control" name="content" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label>Kategori</label>
                <select class="form-control" name="category_id" required>
                    <option value="1">Prestasi</option>
                    <option value="2">Opini</option>
                    <option value="3">Kegiatan</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="../" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>