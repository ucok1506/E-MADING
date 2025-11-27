<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Artikel - E-Mading</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="home.php">
                <i class="fas fa-newspaper me-2"></i>E-Mading SMK
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="javascript:history.back()">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-plus me-2"></i>Buat Artikel Baru</h4>
                    </div>
                    <div class="card-body">
                        <form action="simpan-artikel.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Judul Artikel</label>
                                <input type="text" class="form-control" name="judul" placeholder="Masukkan judul artikel..." required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <select class="form-select" name="kategori">
                                    <option value="">Pilih Kategori</option>
                                    <option value="1">Prestasi</option>
                                    <option value="2">Opini</option>
                                    <option value="3">Kegiatan</option>
                                    <option value="4">Informasi Sekolah</option>
                                    <option value="5">Pengumuman</option>
                                    <option value="6">Berita</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Foto Artikel</label>
                                <input type="file" class="form-control" name="foto" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Isi Artikel</label>
                                <textarea class="form-control" name="isi" rows="10" placeholder="Tulis isi artikel di sini..." required></textarea>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="javascript:history.back()" class="btn btn-secondary">
                                    <i class="fas fa-times me-1"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i>Simpan Artikel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>