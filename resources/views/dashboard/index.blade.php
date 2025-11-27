@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <h1 class="h3 mb-4">Dashboard Pengguna</h1>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Artikel</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_articles'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Artikel Published</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['published_articles'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Draft Artikel</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['draft_articles'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-edit fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Likes</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_likes'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-heart fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Articles -->
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Artikel Terbaru</h6>
                <a href="{{ route('artikel.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i>Buat Artikel
                </a>
            </div>
            <div class="card-body">
                @if($recent_articles->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Views</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_articles as $article)
                            <tr>
                                <td>{{ $article->judul }}</td>
                                <td>
                                    <span class="badge bg-secondary">{{ $article->kategori->nama_kategori ?? 'Uncategorized' }}</span>
                                </td>
                                <td>
                                    @if($article->status === 'publish')
                                        <span class="badge bg-success">Published</span>
                                    @elseif($article->status === 'draft')
                                        <span class="badge bg-warning">Draft</span>
                                    @else
                                        <span class="badge bg-secondary">Archived</span>
                                    @endif
                                </td>
                                <td>{{ $article->likes_count ?? 0 }}</td>
                                <td>{{ $article->tanggal->format('d M Y') }}</td>
                                <td>
                                    @if($article->status === 'publish')
                                        <a href="{{ route('artikel.show', $article->id_artikel) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('artikel.edit', $article->id_artikel) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4">
                    <i class="fas fa-newspaper fa-3x text-gray-300 mb-3"></i>
                    <p class="text-muted">Belum ada artikel. <a href="{{ route('artikel.create') }}">Buat artikel pertama</a></p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection