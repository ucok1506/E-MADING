<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - E-Mading</title>
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
                        <li><a class="dropdown-item" href="#"><i class="fas fa-bell me-2"></i>Notifikasi <span class="badge bg-danger ms-2 notification-count" style="display: none;">0</span></a></li>
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
                            <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-users"></i> Kelola User
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/categories">
                                <i class="fas fa-tags"></i> Kategori
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.approvals') }}">
                                <i class="fas fa-check-double"></i> Persetujuan Artikel
                                @php
                                    $pendingCount = \App\Models\ArticleApproval::where('status', 'pending')->count();
                                @endphp
                                @if($pendingCount > 0)
                                    <span class="badge bg-danger ms-2">{{ $pendingCount }}</span>
                                @endif
                            </a>
                        </li>

                    </ul>
                </div>
            </nav>

            <main class="col-md-10 ms-sm-auto px-md-4">
                <div class="pt-3">
                    <h2>Dashboard Admin</h2>
                    
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ \App\Models\Artikel::count() }}</h4>
                                            <p class="mb-0">Total Artikel</p>
                                        </div>
                                        <i class="fas fa-newspaper fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ \App\Models\Artikel::where('status', 'publish')->count() }}</h4>
                                            <p class="mb-0">Artikel Publish</p>
                                        </div>
                                        <i class="fas fa-check-circle fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ DB::table('artikel')->where('status', 'draft')->count() }}</h4>
                                            <p class="mb-0">Menunggu Persetujuan</p>
                                        </div>
                                        <i class="fas fa-clock fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ \App\Models\User::count() }}</h4>
                                            <p class="mb-0">Total User</p>
                                        </div>
                                        <i class="fas fa-users fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Kelola Artikel</h5>
                                </div>
                                <div class="card-body">


                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Foto</th>
                                                    <th>Judul</th>
                                                    <th>Penulis</th>
                                                    <th>Kategori</th>
                                                    <th>Status</th>
                                                    <th>Tanggal</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($articles as $artikel)
                                                <tr>
                                                    <td>
                                                        @php
                                                            $imagePath = null;
                                                            if($artikel->foto) {
                                                                // Coba berbagai kemungkinan path
                                                                $paths = [
                                                                    'uploads/' . $artikel->foto,
                                                                    'uploads/' . basename($artikel->foto),
                                                                    $artikel->foto
                                                                ];
                                                                foreach($paths as $path) {
                                                                    if(file_exists(public_path($path))) {
                                                                        $imagePath = asset($path);
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        @endphp
                                                        @if($imagePath)
                                                            <img src="{{ $imagePath }}" alt="Foto" style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                                                        @else
                                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                                <i class="fas fa-image text-muted"></i>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <strong>{{ $artikel->judul }}</strong>
                                                        <br><small class="text-muted">{{ Str::limit(strip_tags($artikel->isi), 50) }}</small>
                                                    </td>
                                                    <td>{{ $artikel->user->nama }}</td>
                                                    <td><span class="badge bg-info">{{ $artikel->kategori->nama_kategori ?? 'Umum' }}</span></td>
                                                    <td>
                                                        <span class="badge bg-{{ $artikel->status == 'publish' ? 'success' : 'warning' }}">
                                                            {{ ucfirst($artikel->status) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $artikel->tanggal->format('d/m/Y') }}</td>
                                                    <td>
                                                        <div class="d-flex gap-1">
                                                            <a href="{{ route('artikel.show', $artikel->id_artikel) }}" class="btn btn-sm btn-info" title="Lihat Artikel">
                                                                <i class="fas fa-eye"></i> Lihat
                                                            </a>
                                                            <button class="btn btn-sm btn-danger" onclick="deleteArticle({{ $artikel->id_artikel }}, this)">Hapus</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="7" class="text-center py-4">
                                                        <i class="fas fa-newspaper fa-2x text-muted mb-2"></i>
                                                        <p class="text-muted mb-0">Tidak ada artikel ditemukan</p>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    @if($articles->hasPages())
                                        <div class="d-flex justify-content-center mt-3">
                                            {{ $articles->appends(request()->query())->links() }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .dropdown-toggle::after {
            margin-left: 0.5rem;
        }
        .navbar .dropdown-menu {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
    </style>
    <script>
        // Auto submit form on filter change
        document.querySelectorAll('select[name="status"], select[name="sort"]').forEach(select => {
            select.addEventListener('change', function() {
                this.form.submit();
            });
        });

        // Search form submit
        document.querySelector('button[type="submit"]').addEventListener('click', function(e) {
            e.preventDefault();
            this.form.submit();
        });

        // Enter key search
        document.querySelector('input[name="search"]').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.form.submit();
            }
        });
        
        function loadNotifications() {
            fetch('/notifications/count')
                .then(response => response.json())
                .then(data => {
                    const notificationCount = document.querySelector('.notification-count');
                    if (data.count > 0) {
                        notificationCount.textContent = data.count;
                        notificationCount.style.display = 'inline';
                    } else {
                        notificationCount.style.display = 'none';
                    }
                })
                .catch(error => console.log('Error loading notifications:', error));
        }
        
        document.addEventListener('DOMContentLoaded', loadNotifications);
        setInterval(loadNotifications, 30000);
        
        function deleteArticle(id, button) {
            if (confirm('Yakin hapus artikel ini?')) {
                const row = button.closest('tr');
                row.remove();
                
                fetch(`/artikel/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
            }
        }
    </script>
</body>
</html>