<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian: {{ $query }} - E-Mading SMK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('images/logo-smk.png') }}" alt="Logo SMK" height="40" class="me-2">
                <div>
                    <div class="fw-bold">E-Mading</div>
                    <small class="d-block" style="font-size: 0.7rem;">SMK BAKNUS 666</small>
                </div>
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-12">
                <h2>Hasil Pencarian: "{{ $searchTerm }}"</h2>
                <p class="text-muted">Ditemukan {{ $artikel->total() }} artikel</p>
            </div>
        </div>

        <!-- Search and Filter Form -->
        <div class="row mb-4">
            <div class="col-12">
                <form method="GET" action="{{ route('search') }}">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control" placeholder="Cari artikel..." value="{{ $searchTerm }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select name="kategori" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Kategori</option>
                                @foreach($kategori as $kat)
                                    <option value="{{ $kat->id_kategori }}" {{ request('kategori') == $kat->id_kategori ? 'selected' : '' }}>
                                        {{ $kat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="sort" class="form-select" onchange="this.form.submit()">
                                <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                                <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                                <option value="terpopuler" {{ request('sort') == 'terpopuler' ? 'selected' : '' }}>Terpopuler</option>
                                <option value="judul_az" {{ request('sort') == 'judul_az' ? 'selected' : '' }}>Judul A-Z</option>
                                <option value="judul_za" {{ request('sort') == 'judul_za' ? 'selected' : '' }}>Judul Z-A</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Articles -->
        <div class="row">
            @forelse($artikel as $article)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        @if($article->foto)
                            <img src="{{ asset('uploads/' . $article->foto) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $article->judul }}">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-primary">{{ $article->kategori->nama_kategori ?? 'Umum' }}</span>
                                <small class="text-muted">{{ $article->created_at->diffForHumans() }}</small>
                            </div>
                            <h5 class="card-title">{{ $article->judul }}</h5>
                            <p class="card-text flex-grow-1">{{ Str::limit(strip_tags($article->isi), 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <small class="text-muted">
                                    <i class="fas fa-user" style="font-size: 0.8rem;"></i> {{ $article->user->nama }}
                                </small>
                                <a href="{{ route('artikel.show', $article->id_artikel) }}" class="btn btn-sm btn-primary">
                                    Baca
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-search text-muted mb-3" style="font-size: 3rem;"></i>
                    <h4 class="text-muted">Tidak Ada Hasil</h4>
                    <p class="text-muted">Tidak ditemukan artikel dengan kata kunci "{{ $searchTerm }}"</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
                </div>
            @endforelse
        </div>

        @if($artikel->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $artikel->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>