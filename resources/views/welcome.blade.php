@extends('layout')

@section('title', 'SMK BAKTI NUSANTARA 666 - Beranda')

@section('hero')
<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-4 fw-bold mb-3">Selamat Datang di SMK BAKNUS 666</h1>
                <p class="lead mb-4">Sekolah Menengah Kejuruan Bakti Nusantara 666 - Unggul dalam Prestasi, Berkarakter, dan Siap Kerja</p>
                <div class="d-flex gap-3">
                    <a href="{{ route('mading.index') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-newspaper"></i> E-Mading
                    </a>
                    <a href="#" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-info-circle"></i> Profil Sekolah
                    </a>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <img src="{{ asset('images/logo-smk.png') }}" alt="Logo SMK BAKNUS 666" style="height: 200px;" class="img-fluid">
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Quick Info Section -->
<div class="content-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-3 text-center mb-4">
                <div class="card card-custom h-100 p-4">
                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                    <h4>1200+</h4>
                    <p class="text-muted">Siswa Aktif</p>
                </div>
            </div>
            <div class="col-md-3 text-center mb-4">
                <div class="card card-custom h-100 p-4">
                    <i class="fas fa-chalkboard-teacher fa-3x text-success mb-3"></i>
                    <h4>85+</h4>
                    <p class="text-muted">Tenaga Pendidik</p>
                </div>
            </div>
            <div class="col-md-3 text-center mb-4">
                <div class="card card-custom h-100 p-4">
                    <i class="fas fa-graduation-cap fa-3x text-warning mb-3"></i>
                    <h4>5</h4>
                    <p class="text-muted">Program Keahlian</p>
                </div>
            </div>
            <div class="col-md-3 text-center mb-4">
                <div class="card card-custom h-100 p-4">
                    <i class="fas fa-trophy fa-3x text-danger mb-3"></i>
                    <h4>A</h4>
                    <p class="text-muted">Akreditasi</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Program Keahlian Section -->
<div class="content-section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="fw-bold">Program Keahlian</h2>
                <p class="text-muted">SMK BAKNUS 666 menyediakan berbagai program keahlian yang sesuai dengan kebutuhan industri</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card card-custom">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-code fa-3x text-primary mb-3"></i>
                        <h5>PPLG</h5>
                        <p class="text-muted">Pengembangan Perangkat Lunak dan Gim</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-custom">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-calculator fa-3x text-success mb-3"></i>
                        <h5>AKT</h5>
                        <p class="text-muted">Akuntansi dan Keuangan Lembaga</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-custom">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-palette fa-3x text-warning mb-3"></i>
                        <h5>DKV</h5>
                        <p class="text-muted">Desain Komunikasi Visual</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card card-custom">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-film fa-3x text-info mb-3"></i>
                        <h5>ANIMASI</h5>
                        <p class="text-muted">Animasi 2D dan 3D</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card card-custom">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-chart-line fa-3x text-danger mb-3"></i>
                        <h5>PEMASARAN</h5>
                        <p class="text-muted">Bisnis Daring dan Pemasaran</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- E-Mading Preview Section -->
<div class="content-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="fw-bold">E-Mading Terbaru</h2>
                <p class="text-muted">Informasi dan artikel terbaru dari civitas akademika SMK BAKNUS 666</p>
            </div>
        </div>
        <div class="row">
            @php
                $latestMadings = \App\Models\Mading::where('is_published', true)->latest()->take(3)->get();
            @endphp
            
            @forelse($latestMadings as $mading)
            <div class="col-md-4 mb-4">
                <div class="card card-custom">
                    @if($mading->image)
                        <img src="{{ asset('storage/' . $mading->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h6 class="card-title">{{ $mading->title }}</h6>
                        <p class="card-text small text-muted">{{ Str::limit($mading->content, 80) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">{{ $mading->author }}</small>
                            <a href="{{ route('mading.show', $mading) }}" class="btn btn-sm btn-primary">Baca</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada artikel tersedia</p>
                <a href="{{ route('mading.create') }}" class="btn btn-primary">Tulis Artikel Pertama</a>
            </div>
            @endforelse
        </div>
        @if($latestMadings->count() > 0)
        <div class="text-center">
            <a href="{{ route('mading.index') }}" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-newspaper"></i> Lihat Semua E-Mading
            </a>
        </div>
        @endif
    </div>
</div>
@endsection