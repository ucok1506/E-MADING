<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $mading->title }} - E-Mading SMK</title>
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
                @auth
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                @else
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <article class="card">
                    <div class="card-body">
                        <!-- Article Header -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge bg-primary">{{ $mading->category->name ?? 'Umum' }}</span>
                                <small class="text-muted">{{ $mading->created_at->format('d M Y, H:i') }}</small>
                            </div>
                            <h1 class="mb-3">{{ $mading->title }}</h1>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-user-circle text-muted me-2" style="font-size: 1.5rem;"></i>
                                <div>
                                    <strong>{{ $mading->author }}</strong><br>
                                    <small class="text-muted">Penulis</small>
                                </div>
                            </div>
                        </div>

                        <!-- Article Image -->
                        @if($mading->image)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $mading->image) }}" class="img-fluid rounded" alt="{{ $mading->title }}">
                            </div>
                        @endif

                        <!-- Article Content -->
                        <div class="article-content">
                            {!! nl2br(e($mading->content)) !!}
                        </div>

                        <!-- Article Footer -->
                        <hr class="my-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <button class="btn btn-outline-danger like-btn me-3 {{ $isLiked ? 'btn-danger' : '' }}" data-id="{{ $mading->id }}">
                                    <i class="fas fa-heart" style="font-size: 0.8rem;"></i> <span class="like-count">{{ $mading->likes_count }}</span>
                                </button>
                                <small class="text-muted">
                                    <i class="fas fa-eye" style="font-size: 0.8rem;"></i> {{ $mading->views }} views
                                </small>
                            </div>
                            <div>
                                <button class="btn btn-outline-secondary" onclick="shareArticle()">
                                    <i class="fas fa-share" style="font-size: 0.8rem;"></i> Bagikan
                                </button>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            
            <div class="col-md-4">
                <!-- Article Info -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>Informasi Artikel</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-2"><strong>Kategori:</strong> {{ $mading->category->name ?? 'Umum' }}</p>
                        <p class="mb-2"><strong>Penulis:</strong> {{ $mading->author }}</p>
                        <p class="mb-2"><strong>Dipublikasi:</strong> {{ $mading->created_at->format('d M Y') }}</p>
                        <p class="mb-0"><strong>Dibaca:</strong> {{ $mading->views }} kali</p>
                    </div>
                </div>

                <!-- Back to Home -->
                <div class="card">
                    <div class="card-body text-center">
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left" style="font-size: 0.8rem;"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
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
        document.querySelector('.like-btn').addEventListener('click', function() {
            const articleId = this.dataset.id;
            const likeCount = this.querySelector('.like-count');
            
            fetch(`/mading/${articleId}/like`, {
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

        function shareArticle() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $mading->title }}',
                    text: '{{ Str::limit(strip_tags($mading->content), 100) }}',
                    url: window.location.href
                });
            } else {
                navigator.clipboard.writeText(window.location.href);
                alert('Link artikel telah disalin ke clipboard!');
            }
        }
    </script>
</body>
</html>