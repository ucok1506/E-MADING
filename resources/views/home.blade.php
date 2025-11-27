<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Mading SMK BAKNUS 666</title>
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

    <!-- Header -->
    <div class="bg-light py-4 border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-2 text-center">
                    <img src="{{ asset('images/logo-smk.png') }}" alt="Logo SMK" class="img-fluid" style="max-height: 80px;">
                </div>
                <div class="col-md-10">
                    <h2 class="mb-1 text-primary fw-bold">SMK BAKTI NUSANTARA 666</h2>
                    <p class="mb-0 text-muted">Sekolah Menengah Kejuruan</p>
                    <small class="text-muted">Mading Digital - Berbagi Informasi dan Inspirasi</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mt-4">
        <!-- Search and Filter -->
        <div class="row mb-4">
            <div class="col-12">
                <form method="GET" action="{{ route('home') }}">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control" placeholder="Cari artikel..." value="{{ request('q') }}">
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

        <!-- Quick Category Filter -->
        <div class="row mb-4">
            <div class="col-12">
                <h5>Kategori Populer</h5>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('home') }}" class="btn {{ !request('kategori') ? 'btn-primary' : 'btn-outline-primary' }}">Semua</a>
                    @foreach($kategori as $kat)
                        <a href="{{ route('home', ['kategori' => $kat->id_kategori]) }}" class="btn {{ request('kategori') == $kat->id_kategori ? 'btn-primary' : 'btn-outline-primary' }}">
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
                        @php
                            $imagePath = null;
                            if($art->foto) {
                                if(file_exists(public_path('uploads/' . $art->foto))) {
                                    $imagePath = asset('uploads/' . $art->foto);
                                } elseif(file_exists(public_path('storage/' . $art->foto))) {
                                    $imagePath = asset('storage/' . $art->foto);
                                } elseif(file_exists(public_path('uploads/' . basename($art->foto)))) {
                                    $imagePath = asset('uploads/' . basename($art->foto));
                                }
                            }
                        @endphp
                        @if($imagePath)
                            <img src="{{ $imagePath }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $art->judul }}">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-primary">{{ $art->kategori->nama_kategori ?? 'Umum' }}</span>
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
                    <h4 class="text-muted">Belum Ada Artikel</h4>
                    <p class="text-muted">Belum ada artikel yang dipublikasi.</p>
                </div>
            @endforelse
        </div>

        @if($artikel->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $artikel->links() }}
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