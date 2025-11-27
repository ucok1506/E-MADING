@extends('layout')

@section('title', 'Prestasi - SMK BAKNUS 666')

@section('hero')
<div class="hero-section">
    <div class="container">
        <div class="text-center">
            <h1 class="display-4 fw-bold mb-3">Prestasi</h1>
            <p class="lead">Kebanggaan SMK BAKNUS 666</p>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card card-custom">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <i class="fas fa-trophy fa-3x text-warning"></i>
                        </div>
                        <h5>Juara 1 Lomba Programming</h5>
                        <p class="text-muted">Tingkat Provinsi Jawa Barat 2024</p>
                        <small class="text-primary">Andi Pratama - XII PPLG</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-custom">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <i class="fas fa-medal fa-3x text-secondary"></i>
                        </div>
                        <h5>Juara 2 Desain Grafis</h5>
                        <p class="text-muted">Kompetisi Nasional 2024</p>
                        <small class="text-primary">Sari Indah - XI DKV</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-custom">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <i class="fas fa-award fa-3x text-danger"></i>
                        </div>
                        <h5>Juara 3 Animasi</h5>
                        <p class="text-muted">Festival Film Pelajar 2024</p>
                        <small class="text-primary">Tim ANIMASI SMK BAKNUS 666</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card card-custom">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <i class="fas fa-star fa-3x text-success"></i>
                        </div>
                        <h5>Sekolah Adiwiyata</h5>
                        <p class="text-muted">Penghargaan sekolah peduli lingkungan tingkat kabupaten</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card card-custom">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <i class="fas fa-certificate fa-3x text-info"></i>
                        </div>
                        <h5>Akreditasi A</h5>
                        <p class="text-muted">Terakreditasi A dari Badan Akreditasi Nasional</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection