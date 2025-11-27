<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Mading')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/logo-smk.png') }}" alt="Logo SMK" height="40" class="me-2">
                <div>
                    <div class="fw-bold">E-Mading</div>
                    <small class="d-block" style="font-size: 0.7rem; line-height: 1;">SMK BAKNUS 666</small>
                </div>
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('mading.index') }}">Beranda</a>
                <a class="nav-link" href="{{ route('mading.create') }}">Buat Mading</a>
            </div>
        </div>
    </nav>

    <!-- Header Sekolah -->
    <div class="bg-light py-3 border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-2 text-center">
                    <img src="{{ asset('images/logo-smk.png') }}" alt="Logo SMK BAKNUS 666" class="img-fluid" style="max-height: 80px;">
                </div>
                <div class="col-md-10">
                    <h2 class="mb-1 text-primary fw-bold">SMK BAKTI NUSANTARA 666</h2>
                    <p class="mb-0 text-muted">Sekolah Menengah Kejuruan</p>
                    <small class="text-muted">Mading Digital - Berbagi Informasi dan Inspirasi</small>
                </div>
            </div>
        </div>
    </div>

    <main class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-light mt-5 py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('images/logo-smk.png') }}" alt="Logo SMK" height="50" class="me-3">
                        <div>
                            <h5 class="mb-1">SMK BAKNUS 666</h5>
                            <small>Bakti Nusantara</small>
                        </div>
                    </div>
                    <p class="small">Sekolah Menengah Kejuruan yang berkomitmen menghasilkan lulusan berkualitas dan siap kerja.</p>
                </div>
                <div class="col-md-4">
                    <h6>Kontak</h6>
                    <p class="small mb-1"><i class="fas fa-map-marker-alt"></i>Jl. Percobaan KM. 17 No. 65, Cileunyi, Kabupaten Bandung, Jawa Barat.</p>
                    <p class="small mb-1"><i class="fas fa-phone"></i> (021) 123-4567</p>
                    <p class="small mb-1"><i class="fas fa-envelope"></i> info@smkbaknus666.sch.id</p>
                </div>
                <div class="col-md-4">
                    <h6>E-Mading</h6>
                    <p class="small">Platform digital untuk berbagi informasi, pengumuman, dan artikel dari civitas akademika SMK BAKNUS 666.</p>
                </div>
            </div>
            <hr class="my-3">
            <div class="text-center">
                <small>&copy; {{ date('Y') }} SMK BAKTI NUSANTARA 666. All rights reserved.</small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>