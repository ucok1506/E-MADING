@extends('emading-layout')

@section('title', $category->name . ' - E-Mading SMK BAKNUS 666')

@section('content')
<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">{{ $category->name }}</li>
        </ol>
    </nav>

    <!-- Category Header -->
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-primary">{{ $category->name }}</h1>
        <p class="lead text-muted">Artikel dalam kategori {{ $category->name }}</p>
    </div>

    @if($articles->count() > 0)
        <div class="row">
            @foreach($articles as $article)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <span class="badge bg-primary mb-2">{{ $category->name }}</span>
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ Str::limit($article->content, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <small class="text-muted">
                                <i class="fas fa-user me-1"></i>{{ $article->author }}
                            </small>
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>{{ $article->created_at->format('d M Y') }}
                            </small>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-muted me-3">
                                    <i class="fas fa-eye"></i> {{ $article->views ?? 0 }}
                                </span>
                                <span class="text-muted">
                                    <i class="fas fa-heart text-danger"></i> {{ $article->likesCount() }}
                                </span>
                            </div>
                            <a href="{{ url('/mading/' . $article->id) }}" class="btn btn-sm btn-primary">Baca</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($articles->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $articles->links() }}
        </div>
        @endif
    @else
        <div class="text-center py-5">
            <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
            <h4>Belum ada artikel</h4>
            <p class="text-muted">Belum ada artikel dalam kategori {{ $category->name }}</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
        </div>
    @endif
</div>
@endsection