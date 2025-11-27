<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Artikel - E-Mading SMK BAKNUS 666</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .pagination svg {
            width: 16px !important;
            height: 16px !important;
        }
        .pagination .page-link {
            padding: 0.375rem 0.75rem;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-newspaper me-2"></i>E-Mading SMK
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    @php $categories = \App\Models\Category::all(); @endphp
                    @foreach($categories as $cat)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category', $cat->slug) }}">{{ $cat->name }}</a>
                    </li>
                    @endforeach
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link text-white">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manajemen Artikel</h2>
    <form action="{{ route('mading.create') }}" method="GET" class="d-inline">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Buat Artikel Baru
        </button>
    </form>
</div>

<div class="card shadow">
    <div class="card-body">
        @if($madings->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Views</th>
                        <th>Likes</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($madings as $mading)
                    <tr>
                        <td>
                            <strong>{{ $mading->title }}</strong>
                            @if($mading->is_featured)
                                <span class="badge bg-warning ms-1">Featured</span>
                            @endif
                            <br>
                            <small class="text-muted">{{ $mading->author }}</small>
                        </td>
                        <td>
                            @if($mading->category && is_object($mading->category))
                                <span class="badge bg-secondary">{{ $mading->category->name }}</span>
                            @else
                                <span class="text-muted">Tidak ada kategori</span>
                            @endif
                        </td>
                        <td>
                            @if($mading->status === 'published')
                                <span class="badge bg-success">Published</span>
                            @elseif($mading->status === 'draft')
                                <span class="badge bg-warning">Draft</span>
                            @else
                                <span class="badge bg-secondary">Archived</span>
                            @endif
                        </td>
                        <td>{{ $mading->views }}</td>
                        <td>{{ $mading->likesCount() }}</td>
                        <td>{{ $mading->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('mading.show', $mading) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('mading.edit', $mading) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('mading.destroy', $mading) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
            <h4 class="text-muted">Belum ada artikel</h4>
            <p class="text-muted">Mulai dengan membuat artikel pertama Anda</p>
            <form action="{{ route('mading.create') }}" method="GET" class="d-inline">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Buat Artikel Baru
                </button>
            </form>
        </div>
        @endif
    </div>
</div>

@if($madings->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $madings->links() }}
</div>
@endif

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>