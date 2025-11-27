@extends('layout')

@section('title', 'Profil - SMK BAKNUS 666')

@section('hero')
<div class="hero-section">
    <div class="container">
        <div class="text-center">
            <h1 class="display-4 fw-bold mb-3">Profil Sekolah</h1>
            <p class="lead">SMK BAKTI NUSANTARA 666</p>
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
                    <div class="card-body text-center p-4">
                        <i class="fas fa-history fa-3x text-primary mb-3"></i>
                        <h5>Sejarah</h5>
                        <p class="text-muted">SMK BAKNUS 666 didirikan pada tahun 1995 dengan visi menjadi sekolah kejuruan terdepan.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-custom">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-eye fa-3x text-success mb-3"></i>
                        <h5>Visi</h5>
                        <p class="text-muted">Menjadi SMK unggul yang menghasilkan lulusan berkarakter, kompeten, dan siap kerja.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-custom">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-bullseye fa-3x text-warning mb-3"></i>
                        <h5>Misi</h5>
                        <p class="text-muted">Menyelenggarakan pendidikan kejuruan berkualitas dengan teknologi terkini.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection