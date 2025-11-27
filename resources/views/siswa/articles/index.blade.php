@extends('layouts.siswa')

@section('title', 'Artikel Saya')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Artikel Saya</h2>
            <a href="{{ route('siswa.articles.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Buat Artikel Baru
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @forelse($articles as $article)
            <div class="row border-bottom py-3">
                <div class="col-md-2">
                    @if($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}" class="img-fluid rounded" alt="{{ $article->title }}">
                    @else
                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 80px;">
                            <i class="fas fa-image text-muted"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-7">
                    <h5 class="mb-2">{{ $article->title }}</h5>
                    <p class="text-muted mb-2">{{ Str::limit(strip_tags($article->content), 150) }}</p>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-{{ $article->status === 'published' ? 'success' : ($article->status === 'pending' ? 'warning' : 'secondary') }} me-2">
                            {{ ucfirst($article->status) }}
                        </span>
                        <small class="text-muted me-3">
                            <i class="fas fa-heart"></i> {{ $article->likes_count }} likes
                        </small>
                        <small class="text-muted me-3">
                            <i class="fas fa-eye"></i> {{ $article->views }} views
                        </small>
                        <small class="text-muted">
                            <i class="fas fa-calendar"></i> {{ $article->created_at->format('d M Y') }}
                        </small>
                    </div>
                </div>
                <div class="col-md-3 text-end">
                    <div class="btn-group" role="group">
                        @if($article->status === 'published')
                            <a href="{{ route('mading.show', $article->id) }}" class="btn btn-sm btn-outline-info" target="_blank">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                        @endif
                        <a href="{{ route('siswa.articles.edit', $article->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form method="POST" action="{{ route('siswa.articles.destroy', $article->id) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus artikel ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Belum Ada Artikel</h4>
                <p class="text-muted">Anda belum membuat artikel apapun.</p>
                <a href="{{ route('siswa.articles.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Buat Artikel Pertama
                </a>
            </div>
        @endforelse
    </div>
</div>

@if($articles->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $articles->links() }}
    </div>
@endif
@endsection