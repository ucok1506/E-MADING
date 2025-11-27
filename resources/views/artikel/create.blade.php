<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Artikel - E-Mading</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-newspaper"></i> E-Mading
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Buat Artikel Baru</h2>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('artikel.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Judul Artikel *</label>
                                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" required value="{{ old('judul') }}">
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kategori *</label>
                                <select name="id_kategori" class="form-select @error('id_kategori') is-invalid @enderror" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategori as $kat)
                                        <option value="{{ $kat->id_kategori }}" {{ old('id_kategori') == $kat->id_kategori ? 'selected' : '' }}>
                                            {{ $kat->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Foto Artikel</label>
                                <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Isi Artikel *</label>
                                <textarea name="isi" class="form-control @error('isi') is-invalid @enderror" rows="15" required>{{ old('isi') }}</textarea>
                                @error('isi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Artikel
                                </button>
                                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Panduan Menulis</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-check text-success"></i>
                                <strong>Judul Menarik:</strong> Buat judul yang informatif dan menarik perhatian
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success"></i>
                                <strong>Pilih Kategori:</strong> Sesuaikan dengan topik artikel Anda
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success"></i>
                                <strong>Foto Pendukung:</strong> Tambahkan foto yang relevan dengan artikel
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success"></i>
                                <strong>Konten Berkualitas:</strong> Tulis dengan bahasa yang jelas dan mudah dipahami
                            </li>
                        </ul>
                    </div>
                </div>

                @if(auth()->user()->role === 'siswa')
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Informasi</h5>
                    </div>
                    <div class="card-body">
                        <p class="small text-muted">
                            <i class="fas fa-info-circle"></i>
                            Artikel yang Anda buat akan disimpan sebagai draft dan perlu persetujuan admin/guru sebelum dipublikasi.
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>