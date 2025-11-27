<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kategori_selected->nama_kategori }} - E-Mading SMK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
                @auth
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                @else
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">{{ $kategori_selected->nama_kategori }}</li>
            </ol>
        </nav>

        <!-- Category Header -->
        <div class="text-center mb-4">
            <h1 class="display-6 fw-bold text-primary">{{ $kategori_selected->nama_kategori }}</h1>
            <p class="lead text-muted">Artikel dalam kategori {{ $kategori_selected->nama_kategori }}</p>
        </div>

        <!-- Search and Filter -->
        <div class="row mb-4">
            <div class="col-12">
                <form method="GET">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control" placeholder="Cari dalam kategori {{ $kategori_selected->nama_kategori }}..." value="{{ request('q') }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4">
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

        <!-- Category Navigation -->
        <div class="row mb-4">
            <div class="col-12">
                <h6>Kategori Lainnya:</h6>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm">Semua</a>
                    @foreach($kategori as $kat)
                        <a href="{{ route('kategori', $kat->id_kategori) }}" 
                           class="btn {{ $kat->id_kategori == $kategori_selected->id_kategori ? 'btn-primary' : 'btn-outline-primary' }} btn-sm">
                            {{ $kat->nama_kategori }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Articles -->
        <div class="row">
            @forelse($artikel as $art)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        @if($art->foto)
                            <img src="{{ asset('uploads/' . $art->foto) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $art->judul }}">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-primary">{{ $art->kategori->nama_kategori }}</span>
                                <small class="text-muted">{{ $art->tanggal->diffForHumans() }}</small>
                            </div>
                            <h5 class="card-title">{{ $art->judul }}</h5>
                            <p class="card-text flex-grow-1">{{ Str::limit(strip_tags($art->isi), 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <small class="text-muted">
                                    <i class="fas fa-user"></i> {{ $art->user->nama }}
                                </small>
                                <div>
                                    <button class="btn btn-sm btn-outline-danger like-btn me-2" data-id="{{ $art->id_artikel }}">
                                        <i class="fas fa-heart"></i> <span class="like-count">{{ $art->likes_count }}</span>
                                    </button>
                                    <a href="{{ route('artikel.show', $art->id_artikel) }}" class="btn btn-sm btn-primary">
                                        Baca
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Tidak Ada Artikel</h4>
                    @if(request('q'))
                        <p class="text-muted">Tidak ditemukan artikel dengan kata kunci "{{ request('q') }}" dalam kategori {{ $kategori_selected->nama_kategori }}.</p>
                        <a href="{{ route('kategori', $kategori_selected->id_kategori) }}" class="btn btn-primary">Lihat Semua Artikel</a>
                    @else
                        <p class="text-muted">Belum ada artikel dalam kategori {{ $kategori_selected->nama_kategori }}.</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
                    @endif
                </div>
            @endforelse
        </div>

        @if($artikel->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $artikel->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-light mt-5 py-4">
        <div class="container">
            <div class="text-center">
                <small>&copy; {{ date('Y') }} SMK BAKTI NUSANTARA 666. All rights reserved.</small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Like functionality
        document.querySelectorAll('.like-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const artikelId = this.dataset.id;
                const likeCount = this.querySelector('.like-count');
                
                fetch(`/artikel/${artikelId}/like`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        likeCount.textContent = data.likes_count;
                        this.classList.toggle('btn-outline-danger');
                        this.classList.toggle('btn-danger');
                    } else if (data.message === 'Login required') {
                        window.location.href = '{{ route("login") }}';
                    }
                });
            });
        });
    </script>
</body>
</html>