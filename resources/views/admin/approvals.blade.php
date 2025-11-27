<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persetujuan Artikel - Admin E-Mading</title>
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
                            <a class="nav-link" href="#">
                                <i class="fas fa-tags"></i> Kategori
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('admin.approvals') }}">
                                <i class="fas fa-check-double"></i> Persetujuan Artikel
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-10 ms-sm-auto px-md-4">
                <div class="pt-3">
                    <h2>Persetujuan Artikel</h2>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Artikel Menunggu Persetujuan</h5>
                        </div>
                        <div class="card-body">
                            @forelse($approvals as $approval)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                @php
                                                    $imagePath = null;
                                                    if($approval->artikel->foto) {
                                                        if(file_exists(public_path('uploads/' . $approval->artikel->foto))) {
                                                            $imagePath = asset('uploads/' . $approval->artikel->foto);
                                                        } elseif(file_exists(public_path('storage/' . $approval->artikel->foto))) {
                                                            $imagePath = asset('storage/' . $approval->artikel->foto);
                                                        } elseif(file_exists(public_path('uploads/' . basename($approval->artikel->foto)))) {
                                                            $imagePath = asset('uploads/' . basename($approval->artikel->foto));
                                                        }
                                                    }
                                                @endphp
                                                @if($imagePath)
                                                    <img src="{{ $imagePath }}" alt="Foto" class="img-fluid rounded" style="max-height: 100px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 100px;">
                                                        <i class="fas fa-image text-muted fa-2x"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-7">
                                                <h5>{{ $approval->artikel->judul }}</h5>
                                                <p class="text-muted mb-2">
                                                    <i class="fas fa-user"></i> {{ $approval->user->nama }} 
                                                    <span class="badge bg-info ms-2">{{ ucfirst($approval->user->role) }}</span>
                                                </p>
                                                <p class="mb-2">{{ Str::limit(strip_tags($approval->artikel->isi), 150) }}</p>
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar"></i> Dikirim: {{ now()->format('d/m/Y H:i') }}
                                                </small>
                                            </div>
                                            <div class="col-md-3 text-end">
                                                <div class="d-grid gap-2">
                                                    <a href="{{ route('artikel.show', $approval->artikel->id_artikel) }}" class="btn btn-info">
                                                        <i class="fas fa-eye"></i> Lihat Artikel
                                                    </a>
                                                    <button class="btn btn-success" onclick="approveArticle({{ $approval->artikel->id_artikel }})">
                                                        <i class="fas fa-check"></i> Setujui
                                                    </button>
                                                    <button class="btn btn-warning" onclick="showRejectModal({{ $approval->artikel->id_artikel }}, '{{ $approval->artikel->judul }}')">
                                                        <i class="fas fa-times"></i> Tolak
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <i class="fas fa-check-circle fa-3x text-muted mb-3"></i>
                                    <h4 class="text-muted">Tidak Ada Artikel Menunggu</h4>
                                    <p class="text-muted">Semua artikel sudah disetujui atau ditolak</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tolak Artikel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="rejectForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Anda akan menolak artikel: <strong id="articleTitle"></strong></p>
                        <div class="mb-3">
                            <label class="form-label">Alasan Penolakan *</label>
                            <textarea name="alasan" class="form-control" rows="3" required placeholder="Berikan alasan penolakan..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">Tolak Artikel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function approveArticle(id) {
            if (confirm('Setujui artikel ini?')) {
                fetch(`/admin/approvals/${id}/approve`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Artikel berhasil disetujui!');
                        location.reload();
                    } else {
                        alert('Gagal: ' + data.message);
                    }
                })
                .catch(error => {
                    console.log('Error:', error);
                    alert('Error: ' + error.message);
                });
            }
        }

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
        
        function showRejectModal(id, title) {
            document.getElementById('articleTitle').textContent = title;
            document.getElementById('rejectForm').action = `/admin/approvals/${id}/reject`;
            new bootstrap.Modal(document.getElementById('rejectModal')).show();
        }
    </script>
</body>
</html>