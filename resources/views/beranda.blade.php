@extends('emading-layout')

@section('title', 'Beranda - E-Mading SMK BAKNUS 666')

@section('content')
<!-- Hero Welcome Section -->
<div class="hero-section">
    <div class="container">
        <h1 class="hero-title">👋 Selamat Datang, {{ auth()->user()->name }}!</h1>
        <p class="hero-subtitle">Bagikan ide, kreativitas, dan inspirasi Anda di E-Mading SMK BAKNUS 666</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('mading.create') }}" class="btn btn-light btn-lg">
                <i class="fas fa-pen me-2"></i>Mulai Menulis
            </a>
            <a href="{{ route('mading.index') }}" class="btn btn-outline-light btn-lg">
                <i class="fas fa-newspaper me-2"></i>Jelajahi Artikel
            </a>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="stats-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-3 stat-item">
                <div class="stat-number">{{ \App\Models\Mading::where('is_published', true)->count() }}</div>
                <div class="stat-label"><i class="fas fa-newspaper me-1"></i>Total Artikel</div>
            </div>
            <div class="col-md-3 stat-item">
                <div class="stat-number">{{ \App\Models\User::count() }}</div>
                <div class="stat-label"><i class="fas fa-users me-1"></i>Penulis Aktif</div>
            </div>
            <div class="col-md-3 stat-item">
                <div class="stat-number">{{ \App\Models\Mading::whereDate('created_at', today())->count() }}</div>
                <div class="stat-label"><i class="fas fa-calendar me-1"></i>Hari Ini</div>
            </div>
            <div class="col-md-3 stat-item">
                <div class="stat-number">{{ \App\Models\Like::count() }}</div>
                <div class="stat-label"><i class="fas fa-heart me-1"></i>Total Likes</div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Articles Section -->
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold"><i class="fas fa-star text-warning me-2"></i>Artikel Unggulan</h2>
        <a href="{{ route('mading.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-right me-1"></i>Lihat Semua
        </a>
    </div>
</div>

<div class="article-grid">
    @php
        $featuredMadings = \App\Models\Mading::where('is_published', true)
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();
        
        if($featuredMadings->count() < 6) {
            $additionalMadings = \App\Models\Mading::where('is_published', true)
                ->where('is_featured', false)
                ->latest()
                ->take(6 - $featuredMadings->count())
                ->get();
            $featuredMadings = $featuredMadings->concat($additionalMadings);
        }
    @endphp
    
    @forelse($featuredMadings as $mading)
        <div class="article-card">
            @if($mading->is_featured)
                <span class="featured-badge">
                    <i class="fas fa-star me-1"></i>Featured
                </span>
            @endif
            
            @php
                $categoryColors = [
                    'pengumuman' => 'bg-info',
                    'artikel' => 'bg-primary', 
                    'berita' => 'bg-success',
                    'prestasi' => 'bg-warning',
                    'kegiatan' => 'bg-purple',
                    'informasi' => 'bg-secondary'
                ];
                $categoryIcons = [
                    'pengumuman' => 'fas fa-bullhorn',
                    'artikel' => 'fas fa-file-alt',
                    'berita' => 'fas fa-newspaper', 
                    'prestasi' => 'fas fa-trophy',
                    'kegiatan' => 'fas fa-calendar-check',
                    'informasi' => 'fas fa-info-circle'
                ];
            @endphp
            
            <span class="category-badge {{ $categoryColors[$mading->category ?? 'artikel'] ?? 'bg-primary' }}">
                <i class="{{ $categoryIcons[$mading->category ?? 'artikel'] ?? 'fas fa-file-alt' }} me-1"></i>
                {{ ucfirst($mading->category ?? 'Artikel') }}
            </span>
            
            @if($mading->image)
                <img src="{{ asset('storage/' . $mading->image) }}" class="article-image" style="height: 200px; object-fit: cover; width: 100%;">
            @else
                <div class="article-image">
                    <i class="{{ $categoryIcons[$mading->category ?? 'artikel'] ?? 'fas fa-newspaper' }}"></i>
                </div>
            @endif
            
            <div class="article-content">
                <h3 class="article-title">{{ $mading->title }}</h3>
                <p class="article-excerpt">{{ Str::limit(strip_tags($mading->content), 120) }}</p>
                
                <div class="article-meta">
                    <div class="author-avatar">
                        {{ substr($mading->author, 0, 1) }}
                    </div>
                    <div>
                        <div class="fw-semibold">{{ $mading->author }}</div>
                        <div class="small">
                            <i class="fas fa-calendar me-1"></i>{{ $mading->created_at->format('d M Y') }}
                            <i class="fas fa-eye ms-2 me-1"></i>{{ $mading->views ?? 0 }}
                        </div>
                    </div>
                </div>
                
                <div class="article-footer">
                    <a href="{{ route('mading.show', $mading) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-eye me-1"></i>Baca Selengkapnya
                    </a>
                    
                    <div class="d-flex gap-2 align-items-center">
                        <span class="small text-muted">
                            <i class="fas fa-heart me-1"></i>{{ $mading->likesCount() }}
                        </span>
                        <span class="small text-muted">{{ $mading->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="container text-center py-5">
            <i class="fas fa-newspaper" style="font-size: 5rem; color: #e2e8f0; margin-bottom: 2rem;"></i>
            <h3 class="mb-3">Belum Ada Artikel</h3>
            <p class="text-muted mb-4">Jadilah yang pertama menulis artikel di E-Mading SMK BAKNUS 666!</p>
            <a href="{{ route('mading.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-pen me-2"></i>Tulis Artikel Pertama
            </a>
        </div>
    @endforelse
</div>

<!-- Quick Actions -->
<div class="row mt-5">
    <div class="col-12">
        <div class="card card-emading">
            <div class="card-body p-4">
                <h5 class="mb-3"><i class="fas fa-bolt text-warning"></i> Aksi Cepat</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('mading.create') }}" class="btn btn-outline-primary w-100 p-3">
                            <i class="fas fa-edit fa-2x mb-2 d-block"></i>
                            <strong>Tulis Artikel</strong><br>
                            <small>Bagikan ide dan kreativitasmu</small>
                        </a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('mading.index') }}" class="btn btn-outline-success w-100 p-3">
                            <i class="fas fa-newspaper fa-2x mb-2 d-block"></i>
                            <strong>Baca Artikel</strong><br>
                            <small>Temukan artikel menarik</small>
                        </a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <button class="btn btn-outline-info w-100 p-3" onclick="alert('Fitur akan segera hadir!')">
                            <i class="fas fa-share fa-2x mb-2 d-block"></i>
                            <strong>Bagikan</strong><br>
                            <small>Sebarkan artikel favorit</small>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection