@extends('layout')

@section('title', 'Kontak - SMK BAKNUS 666')

@section('hero')
<div class="hero-section">
    <div class="container">
        <div class="text-center">
            <h1 class="display-4 fw-bold mb-3">Kontak Kami</h1>
            <p class="lead">Hubungi SMK BAKNUS 666</p>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card card-custom">
                    <div class="card-body p-4">
                        <h5 class="mb-4"><i class="fas fa-info-circle text-primary"></i> Informasi Kontak</h5>
                        
                        <div class="mb-3">
                            <h6><i class="fas fa-map-marker-alt text-danger"></i> Alamat</h6>
                            <p class="text-muted">Jl. Percobaan KM. 17 No. 65, Cileunyi, Kabupaten Bandung, Jawa Barat</p>
                        </div>
                        
                        <div class="mb-3">
                            <h6><i class="fas fa-phone text-success"></i> Telepon</h6>
                            <p class="text-muted">(022) 123-4567</p>
                        </div>
                        
                        <div class="mb-3">
                            <h6><i class="fas fa-envelope text-primary"></i> Email</h6>
                            <p class="text-muted">info@smkbaknus666.sch.id</p>
                        </div>
                        
                        <div class="mb-3">
                            <h6><i class="fas fa-globe text-info"></i> Website</h6>
                            <p class="text-muted">www.smkbaknus666.sch.id</p>
                        </div>
                        
                        <div class="mb-3">
                            <h6><i class="fas fa-clock text-warning"></i> Jam Operasional</h6>
                            <p class="text-muted">Senin - Jumat: 07.00 - 16.00 WIB<br>Sabtu: 07.00 - 12.00 WIB</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card card-custom">
                    <div class="card-body p-4">
                        <h5 class="mb-4"><i class="fas fa-envelope text-primary"></i> Kirim Pesan</h5>
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Subjek</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pesan</label>
                                <textarea class="form-control" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-12">
                <div class="card card-custom">
                    <div class="card-body p-4">
                        <h5 class="mb-3"><i class="fas fa-map text-primary"></i> Lokasi Sekolah</h5>
                        <div class="ratio ratio-16x9">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.8956147618896!2d107.7688!3d-6.9175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68c2a7e7f7f7f7%3A0x1234567890abcdef!2sJl.%20Percobaan%20KM.%2017%20No.%2065%2C%20Cileunyi%2C%20Kabupaten%20Bandung%2C%20Jawa%20Barat!5e0!3m2!1sen!2sid!4v1234567890123!5m2!1sen!2sid" 
                                style="border:0; border-radius: 10px;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                        <div class="mt-3 text-center">
                            <small class="text-muted">Jl. Percobaan KM. 17 No. 65, Cileunyi, Kabupaten Bandung, Jawa Barat</small><br>
                            <a href="https://maps.google.com/?q=Jl.+Percobaan+KM.+17+No.+65,+Cileunyi,+Kabupaten+Bandung,+Jawa+Barat" target="_blank" class="btn btn-sm btn-primary mt-2">
                                <i class="fas fa-external-link-alt"></i> Buka di Google Maps
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection