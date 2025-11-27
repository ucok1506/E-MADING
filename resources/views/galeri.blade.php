@extends('layout')

@section('title', 'Galeri - SMK BAKNUS 666')

@section('hero')
<div class="hero-section">
    <div class="container">
        <div class="text-center">
            <h1 class="display-4 fw-bold mb-3">Galeri</h1>
            <p class="lead">Dokumentasi Kegiatan SMK BAKNUS 666</p>
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
                    <div class="card-body p-0">
                        <div class="bg-primary text-white text-center p-5">
                            <i class="fas fa-graduation-cap fa-4x mb-3"></i>
                            <h5>Wisuda 2024</h5>
                        </div>
                        <div class="p-3">
                            <p class="text-muted small">Upacara wisuda siswa kelas XII tahun 2024</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-custom">
                    <div class="card-body p-0">
                        <div class="bg-success text-white text-center p-5">
                            <i class="fas fa-trophy fa-4x mb-3"></i>
                            <h5>Lomba Kompetensi</h5>
                        </div>
                        <div class="p-3">
                            <p class="text-muted small">Siswa mengikuti berbagai lomba kompetensi keahlian</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-custom">
                    <div class="card-body p-0">
                        <div class="bg-warning text-white text-center p-5">
                            <i class="fas fa-tools fa-4x mb-3"></i>
                            <h5>Prakerin</h5>
                        </div>
                        <div class="p-3">
                            <p class="text-muted small">Kegiatan Praktik Kerja Industri di berbagai perusahaan</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-custom">
                    <div class="card-body p-0">
                        <div class="bg-info text-white text-center p-5">
                            <i class="fas fa-microscope fa-4x mb-3"></i>
                            <h5>Laboratorium</h5>
                        </div>
                        <div class="p-3">
                            <p class="text-muted small">Fasilitas laboratorium lengkap untuk praktik siswa</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-custom">
                    <div class="card-body p-0">
                        <div class="bg-danger text-white text-center p-5">
                            <i class="fas fa-music fa-4x mb-3"></i>
                            <h5>Pentas Seni</h5>
                        </div>
                        <div class="p-3">
                            <p class="text-muted small">Pertunjukan seni dan budaya siswa SMK BAKNUS 666</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-custom">
                    <div class="card-body p-0">
                        <div class="bg-secondary text-white text-center p-5">
                            <i class="fas fa-running fa-4x mb-3"></i>
                            <h5>Olahraga</h5>
                        </div>
                        <div class="p-3">
                            <p class="text-muted small">Kegiatan olahraga dan ekstrakurikuler</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection