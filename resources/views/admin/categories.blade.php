<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori - Admin E-Mading</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-shield-alt"></i> Admin E-Mading
            </a>
            <div class="navbar-nav ms-auto">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                        <img src="{{ auth()->user()->foto ? asset('uploads/' . auth()->user()->foto) : asset('images/default-avatar.svg') }}" 
                             alt="Profile" class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover;">
                        <span>{{ auth()->user()->nama }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><h6 class="dropdown-header">{{ auth()->user()->nama }}</h6></li>
                        <li><span class="dropdown-item-text small text-muted">{{ ucfirst(auth()->user()->role) }}</span></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-md-block bg-light sidebar">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/create-artikel">
                                <i class="fas fa-plus"></i> Buat Artikel
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-users"></i> Kelola User
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/admin/categories">
                                <i class="fas fa-tags"></i> Kategori
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.approvals') }}">
                                <i class="fas fa-check-double"></i> Persetujuan Artikel
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-10 ms-sm-auto px-md-4">
                <div class="pt-3">
                    <h2>Kelola Kategori</h2>
                    
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Daftar Kategori</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Kategori</th>
                                            <th>Jumlah Artikel</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(\App\Models\Kategori::withCount('artikel')->get() as $kategori)
                                        <tr>
                                            <td>{{ $kategori->id_kategori }}</td>
                                            <td>{{ $kategori->nama_kategori }}</td>
                                            <td>{{ $kategori->artikel_count }}</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function editKategori(id, nama) {
            const newName = prompt('Edit nama kategori:', nama);
            if (newName && newName !== nama) {
                alert('Fitur edit kategori akan segera tersedia');
            }
        }
    </script>
</body>
</html>