<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $artikel->judul }} - E-Mading</title>
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
        <div class="row">
            <div class="col-md-8">
                <article class="card">
                    @php
                        $imagePath = null;
                        if($artikel->foto) {
                            if(file_exists(public_path('uploads/' . $artikel->foto))) {
                                $imagePath = asset('uploads/' . $artikel->foto);
                            } elseif(file_exists(public_path('storage/' . $artikel->foto))) {
                                $imagePath = asset('storage/' . $artikel->foto);
                            } elseif(file_exists(public_path('uploads/' . basename($artikel->foto)))) {
                                $imagePath = asset('uploads/' . basename($artikel->foto));
                            }
                        }
                    @endphp
                    @if($imagePath)
                        <img src="{{ $imagePath }}" class="card-img-top" alt="{{ $artikel->judul }}" style="height: 300px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-primary">{{ $artikel->kategori->nama_kategori }}</span>
                            <small class="text-muted">{{ $artikel->tanggal->format('d M Y, H:i') }}</small>
                        </div>
                        
                        <h1 class="card-title h3">{{ $artikel->judul }}</h1>
                        
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-user-circle fa-2x text-muted me-2"></i>
                            <div>
                                <strong>{{ $artikel->user->nama }}</strong>
                                <br>
                                <small class="text-muted">{{ ucfirst($artikel->user->role) }}</small>
                            </div>
                        </div>
                        
                        <div class="article-content">
                            {!! nl2br(e($artikel->isi)) !!}
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="article-stats">
                                <button class="btn btn-outline-danger btn-sm like-btn" data-artikel-id="{{ $artikel->id_artikel }}">
                                    <i class="fas fa-heart {{ $isLiked ? 'text-danger' : '' }}"></i>
                                    <span class="likes-count">{{ $artikel->likes_count }}</span> Like
                                </button>
                            </div>
                            
                            <div class="share-buttons">
                                <small class="text-muted me-2">Bagikan:</small>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?text={{ urlencode($artikel->judul) }}&url={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($artikel->judul . ' - ' . request()->fullUrl()) }}" target="_blank" class="btn btn-sm btn-outline-success">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Artikel Terkait</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $related_articles = App\Models\Artikel::where('status', 'publish')
                                ->where('id_kategori', $artikel->id_kategori)
                                ->where('id_artikel', '!=', $artikel->id_artikel)
                                ->with(['kategori', 'user'])
                                ->withCount('likes')
                                ->orderBy('tanggal', 'desc')
                                ->limit(5)
                                ->get();
                        @endphp
                        
                        @forelse($related_articles as $related)
                            <div class="d-flex mb-3">
                                @php
                                    $relatedImagePath = null;
                                    if($related->foto) {
                                        if(file_exists(public_path('uploads/' . $related->foto))) {
                                            $relatedImagePath = asset('uploads/' . $related->foto);
                                        } elseif(file_exists(public_path('storage/' . $related->foto))) {
                                            $relatedImagePath = asset('storage/' . $related->foto);
                                        } elseif(file_exists(public_path('uploads/' . basename($related->foto)))) {
                                            $relatedImagePath = asset('uploads/' . basename($related->foto));
                                        }
                                    }
                                @endphp
                                @if($relatedImagePath)
                                    <img src="{{ $relatedImagePath }}" alt="{{ $related->judul }}" class="rounded me-2" style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded me-2 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                                <div class="flex-grow-1">
                                    <a href="{{ route('artikel.show', $related->id_artikel) }}" class="text-decoration-none">
                                        <h6 class="mb-1">{{ Str::limit($related->judul, 50) }}</h6>
                                    </a>
                                    <small class="text-muted">
                                        {{ $related->tanggal->format('d M Y') }} • {{ $related->likes_count }} likes
                                    </small>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">Tidak ada artikel terkait.</p>
                        @endforelse
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h5>Kategori</h5>
                    </div>
                    <div class="card-body">
                        @foreach(App\Models\Kategori::withCount('artikel')->get() as $kat)
                            <a href="{{ route('kategori', $kat->id_kategori) }}" class="badge bg-secondary text-decoration-none me-1 mb-1">
                                {{ $kat->nama_kategori }} ({{ $kat->artikel_count }})
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>E-Mading SMK</h5>
                    <p>Sistem informasi digital untuk berbagi informasi sekolah</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>&copy; 2024 SMK. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const likeBtn = document.querySelector('.like-btn');
            
            if (likeBtn) {
                likeBtn.addEventListener('click', function() {
                    @auth
                        const artikelId = this.dataset.artikelId;
                        
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
                                const heartIcon = this.querySelector('i');
                                const likesCount = this.querySelector('.likes-count');
                                
                                if (data.liked) {
                                    heartIcon.classList.add('text-danger');
                                } else {
                                    heartIcon.classList.remove('text-danger');
                                }
                                
                                likesCount.textContent = data.likes_count;
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    @else
                        alert('Silakan login terlebih dahulu untuk memberikan like.');
                        window.location.href = '{{ route("login") }}';
                    @endauth
                });
            }
        });
    </script>
</body>
</html>