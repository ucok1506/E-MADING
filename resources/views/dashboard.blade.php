<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - E-Mading SMK BAKNUS 666</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .border-left-primary {
            border-left: 0.25rem solid #4e73df !important;
        }
        .border-left-success {
            border-left: 0.25rem solid #1cc88a !important;
        }
        .border-left-warning {
            border-left: 0.25rem solid #f6c23e !important;
        }
        .border-left-info {
            border-left: 0.25rem solid #36b9cc !important;
        }
        .text-xs {
            font-size: 0.7rem;
        }
        .font-weight-bold {
            font-weight: 700;
        }
        .text-gray-800 {
            color: #5a5c69;
        }
        .text-gray-300 {
            color: #dddfeb;
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
                        <a class="nav-link active" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                </ul>
                <form class="d-flex me-3" action="{{ route('search') }}" method="GET">
                    <input class="form-control me-2" type="search" name="q" placeholder="Cari artikel..." value="{{ request('q') }}">
                    <button class="btn btn-outline-light" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                <ul class="navbar-nav">
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle position-relative" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-bell"></i>
                            <span class="badge bg-danger position-absolute top-0 start-100 translate-middle" id="navbar-notification-count" style="display: none;"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" style="width: 300px; max-height: 400px; overflow-y: auto;">
                            <li><h6 class="dropdown-header">Notifikasi</h6></li>
                            <div id="notification-dropdown-content">
                                <li><span class="dropdown-item-text text-muted">Memuat notifikasi...</span></li>
                            </div>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-center" href="{{ route('notifications.index') }}">Lihat Semua</a></li>
                        </ul>
                    </li>
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

    <!-- Dashboard Header -->
    <div class="bg-primary text-white py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2><i class="fas fa-tachometer-alt me-2"></i>Dashboard {{ ucfirst(auth()->user()->role) }}</h2>
                    <p class="mb-0">Selamat datang, {{ auth()->user()->name }}!</p>
                </div>
                <div class="col-md-4 text-end">
                    <!-- Tombol Buat Artikel dihapus -->
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Artikel</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Mading::count() }}</div>
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
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Mading::where('status', 'published')->count() }}</div>
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
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Mading::where('status', 'draft')->count() }}</div>
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
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Like::count() }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-heart fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Articles Management Section -->
    <section class="py-4">
        <div class="container">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Manajemen Artikel</h6>
                    <!-- Tombol Buat Artikel dihapus -->
                </div>
                <div class="card-body">
                    @if($recent_articles->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Status</th>
                                    <th>Views</th>
                                    <th>Likes</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_articles as $article)
                                <tr>
                                    <td>
                                        <strong>{{ $article->title }}</strong>
                                        @if($article->is_featured)
                                            <span class="badge bg-warning ms-1">Featured</span>
                                        @endif
                                        <br>
                                        <small class="text-muted">{{ $article->author }}</small>
                                    </td>
                                    <td>
                                        @if($article->status === 'published')
                                            <span class="badge bg-success">Published</span>
                                        @else
                                            <span class="badge bg-warning">Draft</span>
                                        @endif
                                    </td>
                                    <td>{{ $article->views ?? 0 }}</td>
                                    <td>{{ $article->likesCount() }}</td>
                                    <td>{{ $article->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('mading.edit', $article) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('mading.destroy', $article) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                    <div class="text-center py-4">
                        <i class="fas fa-newspaper fa-3x text-gray-300 mb-3"></i>
                        <p class="text-muted">Belum ada artikel.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Articles with Like Section -->
    <section class="py-4">
        <div class="container">
            <h3 class="mb-4">Artikel Terbaru</h3>
            @if($recent_articles->count() > 0)
                <div class="row">
                    @foreach($recent_articles as $article)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            @if($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $article->title }}</h5>
                                <p class="card-text">{{ Str::limit($article->content, 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="fas fa-user me-1"></i>{{ $article->author }}
                                    </small>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>{{ $article->created_at->format('d M Y') }}
                                    </small>
                                </div>
                                <div class="mt-2 d-flex justify-content-between align-items-center">
                                    <span class="text-muted">
                                        <i class="fas fa-eye"></i> {{ $article->views ?? 0 }}
                                    </span>
                                    <button class="btn btn-sm {{ $article->isLikedBy(auth()->user()) ? 'btn-danger' : 'btn-outline-danger' }}" onclick="likeArticle(this, {{ $article->id }})">
                                        <i class="fas fa-heart"></i> {{ $article->likesCount() }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                    <h4>Belum ada artikel</h4>
                    <p class="text-muted">Jadilah yang pertama menulis artikel di E-Mading SMK BAKNUS 666!</p>
                    <!-- Tombol Tulis Artikel Pertama dihapus -->
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>E-Mading SMK BAKNUS 666</h5>
                    <p>Sistem informasi digital untuk berbagi informasi sekolah</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>&copy; 2024 SMK BAKNUS 666. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function likeArticle(btn, id) {
        if (btn.disabled) return;
        btn.disabled = true;
        
        fetch('/mading/' + id + '/like', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(r => r.json())
        .then(data => {
            if (data && typeof data.likes_count !== 'undefined') {
                // Update hanya text, bukan innerHTML
                const icon = btn.querySelector('i');
                const textNode = btn.childNodes[btn.childNodes.length - 1];
                textNode.textContent = ' ' + data.likes_count;
                
                // Update class
                if (data.liked) {
                    btn.classList.remove('btn-outline-danger');
                    btn.classList.add('btn-danger');
                } else {
                    btn.classList.remove('btn-danger');
                    btn.classList.add('btn-outline-danger');
                }
            }
        })
        .catch(e => {
            console.error('Error:', e);
        })
        .finally(() => {
            btn.disabled = false;
        });
    }
    
    function updateNavbarNotifications() {
        fetch('/notifications/count')
            .then(response => response.json())
            .then(data => {
                const badge = document.getElementById('navbar-notification-count');
                if (data.count > 0) {
                    badge.textContent = data.count;
                    badge.style.display = 'inline';
                } else {
                    badge.style.display = 'none';
                }
            });
    }
    
    function loadNotificationDropdown() {
        fetch('/notifications/recent')
            .then(response => response.json())
            .then(notifications => {
                const content = document.getElementById('notification-dropdown-content');
                
                if (notifications.length > 0) {
                    content.innerHTML = '';
                    notifications.forEach(notif => {
                        const li = document.createElement('li');
                        const isUnread = !notif.is_read;
                        li.innerHTML = `<span class="dropdown-item-text small ${isUnread ? 'fw-bold' : ''}">
                            <i class="fas fa-${notif.type === 'success' ? 'check-circle text-success' : (notif.type === 'warning' ? 'exclamation-triangle text-warning' : (notif.type === 'danger' ? 'times-circle text-danger' : 'info-circle text-info'))} me-1"></i>
                            ${notif.title}
                            ${isUnread ? '<span class="badge bg-primary ms-1">Baru</span>' : ''}
                            <br><small class="text-muted">${notif.message}</small>
                        </span>`;
                        content.appendChild(li);
                    });
                } else {
                    content.innerHTML = '<li><span class="dropdown-item-text text-muted">Tidak ada notifikasi</span></li>';
                }
            });
    }
    
    // Update notifications on page load
    updateNavbarNotifications();
    
    // Load dropdown content when clicked
    document.getElementById('notificationDropdown').addEventListener('click', loadNotificationDropdown);
    
    // Update every 30 seconds
    setInterval(updateNavbarNotifications, 30000);
    </script>
</body>
</html>