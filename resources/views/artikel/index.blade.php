<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel Saya - E-Mading</title>
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
                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Artikel Saya</h2>
                    <div>
                        <a href="{{ route('artikel.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Buat Artikel Baru
                        </a>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if($artikels->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Status</th>
                                            <th>Likes</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($artikels as $artikel)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($artikel->foto)
                                                        <img src="{{ asset('storage/' . $artikel->foto) }}" alt="Thumbnail" class="rounded me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                                    @else
                                                        <div class="bg-light rounded me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                            <i class="fas fa-image text-muted"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <strong>{{ $artikel->judul }}</strong>
                                                        <br>
                                                        <small class="text-muted">{{ Str::limit(strip_tags($artikel->isi), 50) }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $artikel->kategori->nama_kategori }}</span>
                                            </td>
                                            <td>
                                                @if($artikel->status === 'publish')
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check-circle me-1"></i>Published
                                                    </span>
                                                @elseif($artikel->status === 'draft')
                                                    @if($artikel->approval && $artikel->approval->status === 'pending')
                                                        <span class="badge bg-warning">
                                                            <i class="fas fa-clock me-1"></i>Menunggu Review
                                                        </span>
                                                    @elseif($artikel->approval && $artikel->approval->status === 'rejected')
                                                        <span class="badge bg-danger">
                                                            <i class="fas fa-times-circle me-1"></i>Ditolak
                                                        </span>
                                                    @else
                                                        <span class="badge bg-secondary">
                                                            <i class="fas fa-edit me-1"></i>Draft
                                                        </span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <i class="fas fa-heart text-danger me-1"></i>{{ $artikel->likes_count }}
                                            </td>
                                            <td>{{ $artikel->tanggal->format('d M Y') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    @if($artikel->status === 'publish')
                                                        <a href="{{ route('artikel.show', $artikel->id_artikel) }}" class="btn btn-sm btn-outline-info" title="Lihat">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    @endif
                                                    <a href="{{ route('artikel.edit', $artikel->id_artikel) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form method="POST" action="{{ route('artikel.destroy', $artikel->id_artikel) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus artikel ini?')" title="Hapus">
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
                                <h4 class="text-muted">Belum Ada Artikel</h4>
                                <p class="text-muted">Anda belum memiliki artikel. Mulai menulis artikel pertama Anda!</p>
                                <a href="{{ route('artikel.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i>Buat Artikel Pertama
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>