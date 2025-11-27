@extends('layout')

@section('title', 'Akademik - SMK BAKNUS 666')

@section('hero')
<div class="hero-section">
    <div class="container">
        <div class="text-center">
            <h1 class="display-4 fw-bold mb-3">Akademik</h1>
            <p class="lead">Program Pendidikan SMK BAKNUS 666</p>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center mb-4">
                <h2 class="fw-bold">Program Keahlian</h2>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-custom">
                    <div class="card-body p-4">
                        <h5><i class="fas fa-code text-primary"></i> PPLG</h5>
                        <p class="text-muted">Pengembangan Perangkat Lunak dan Gim</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-custom">
                    <div class="card-body p-4">
                        <h5><i class="fas fa-calculator text-success"></i> AKT</h5>
                        <p class="text-muted">Akuntansi dan Keuangan Lembaga</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-custom">
                    <div class="card-body p-4">
                        <h5><i class="fas fa-palette text-warning"></i> DKV</h5>
                        <p class="text-muted">Desain Komunikasi Visual</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card card-custom">
                    <div class="card-body p-4">
                        <h5><i class="fas fa-film text-info"></i> ANIMASI</h5>
                        <p class="text-muted">Animasi 2D dan 3D</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card card-custom">
                    <div class="card-body p-4">
                        <h5><i class="fas fa-chart-line text-danger"></i> PEMASARAN</h5>
                        <p class="text-muted">Bisnis Daring dan Pemasaran</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card card-custom">
                    <div class="card-body p-4">
                        <h5><i class="fas fa-book text-primary"></i> Kurikulum</h5>
                        <p class="text-muted">Menggunakan Kurikulum Merdeka yang disesuaikan dengan kebutuhan industri dan perkembangan teknologi terkini.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card card-custom">
                    <div class="card-body p-4">
                        <h5><i class="fas fa-calendar text-success"></i> Kalender Akademik</h5>
                        <p class="text-muted">Tahun ajaran 2024/2025 dimulai Juli 2024 dengan berbagai kegiatan pembelajaran dan prakerin.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection