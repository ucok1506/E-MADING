<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - E-Mading</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-graduation-cap"></i> Siswa E-Mading
            </a>
            <div class="navbar-nav ms-auto">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                        <img src="{{ auth()->user()->foto ? asset('uploads/' . auth()->user()->foto) : asset('images/default-avatar.svg') }}" 
                             alt="Profile" class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover;">
                        <span>Siswa</span>
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
                            <a class="nav-link active" href="{{ route('siswa.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/buat-artikel.php">
                                <i class="fas fa-plus"></i> Buat Artikel
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/kelola-artikel.php?user_id=1">
                                <i class="fas fa-list"></i> Artikel Saya
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/notifikasi.php?user_id=1">
                                <i class="fas fa-bell"></i> Notifikasi
                                <span class="badge bg-danger ms-2 notification-count" style="display: none;">0</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </nav>

            <main class="col-md-10 ms-sm-auto px-md-4">
                <div class="pt-3">
                    <h2>Dashboard Siswa</h2>
                    
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ DB::table('artikel')->where('id_user', 1)->count() }}</h4>
                                            <p class="mb-0">Artikel Saya</p>
                                        </div>
                                        <i class="fas fa-newspaper fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ DB::table('artikel')->where('id_user', 1)->where('status', 'publish')->count() }}</h4>
                                            <p class="mb-0">Artikel Publish</p>
                                        </div>
                                        <i class="fas fa-check-circle fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ DB::table('like')->whereIn('id_artikel', DB::table('artikel')->where('id_user', 1)->pluck('id_artikel'))->count() }}</h4>
                                            <p class="mb-0">Total Like</p>
                                        </div>
                                        <i class="fas fa-heart fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Artikel Saya</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Foto</th>
                                                    <th>Judul</th>
                                                    <th>Kategori</th>
                                                    <th>Status</th>
                                                    <th>Tanggal</th>
                                                    <th>Like</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $artikels = DB::table('artikel')->where('id_user', 1)->where('status', '!=', 'rejected')->orderBy('tanggal', 'desc')->get();
                                                @endphp
                                                @forelse($artikels as $artikel)
                                                <tr>
                                                    <td>
                                                        @php
                                                            $imagePath = null;
                                                            if($artikel->foto) {
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
                                                    <td>{{ $artikel->judul }}</td>
                                                    <td>{{ DB::table('kategori')->where('id_kategori', $artikel->id_kategori)->value('nama_kategori') ?? 'Tidak ada' }}</td>
                                                    <td>
                                                        @php
                                                            $approval = DB::table('article_approvals')->where('id_artikel', $artikel->id_artikel)->first();
                                                        @endphp
                                                        @if($artikel->status == 'publish')
                                                            <span class="badge bg-success">Publish</span>
                                                        @elseif($approval && $approval->status == 'rejected')
                                                            <span class="badge bg-danger">Ditolak</span>
                                                        @else
                                                            <span class="badge bg-warning">{{ ucfirst($artikel->status) }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ date('d/m/Y', strtotime($artikel->tanggal)) }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-danger like-btn" data-artikel-id="{{ $artikel->id_artikel }}">
                                                            <i class="fas fa-heart"></i> {{ DB::table('like')->where('id_artikel', $artikel->id_artikel)->count() }}
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-1">
                                                            @if($artikel->status == 'publish')
                                                                <a href="{{ route('artikel.show', $artikel->id_artikel) }}" class="btn btn-sm btn-info" title="Lihat Artikel">
                                                                    <i class="fas fa-eye"></i> Lihat
                                                                </a>
                                                            @endif
                                                            @if($artikel->status == 'draft' || ($approval && $approval->status == 'rejected'))
                                                                <a href="/edit-artikel.php?id={{ $artikel->id_artikel }}" class="btn btn-sm btn-primary">
                                                                    <i class="fas fa-edit"></i> Edit
                                                                </a>
                                                            @endif
                                                            @if($approval && $approval->status == 'rejected' && $approval->alasan_penolakan)
                                                                <button class="btn btn-sm btn-warning" onclick="alert('Alasan penolakan: {{ $approval->alasan_penolakan }}')" title="Lihat Alasan">
                                                                    <i class="fas fa-info-circle"></i>
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="7" class="text-center py-4">
                                                        <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                                                        <p class="text-muted">Anda belum memiliki artikel.</p>
                                                        <a href="/buat-artikel.php" class="btn btn-primary">
                                                            <i class="fas fa-plus me-1"></i>Buat Artikel Pertama
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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
                .catch(error => {
                    console.log('Error loading notifications:', error);
                });
        }
        
        function markAsRead(id) {
            fetch(`/notifications/${id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(() => {
                loadNotifications();
                window.location.reload();
            });
        }
        
        function markAllAsRead() {
            fetch('/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(() => {
                loadNotifications();
                window.location.reload();
            });
        }
        
        // Load notifications on page load
        document.addEventListener('DOMContentLoaded', loadNotifications);
        
        // Refresh notifications every 30 seconds
        setInterval(loadNotifications, 30000);
        
        function hapusArtikel(id) {
            if (confirm('Yakin hapus artikel ini?')) {
                fetch('/hapus-artikel.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'artikel_id=' + id
                })
                .then(response => response.text())
                .then(data => {
                    alert('Artikel berhasil dihapus!');
                    location.reload();
                })
                .catch(error => {
                    alert('Error: ' + error);
                });
            }
        }
        
        // Like functionality
        document.querySelectorAll('.like-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const artikelId = this.dataset.artikelId;
                
                fetch('/like-artikel.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `artikel_id=${artikelId}&user_id=1`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.innerHTML = `<i class="fas fa-heart"></i> ${data.total}`;
                        this.classList.toggle('btn-danger', data.liked);
                        this.classList.toggle('btn-outline-danger', !data.liked);
                    }
                });
            });
        });
    </script>
</body>
</html>