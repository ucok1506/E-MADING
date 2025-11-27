@extends('layouts.siswa')

@section('title', 'Buat Artikel Baru')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Buat Artikel Baru</h2>
            <a href="{{ route('siswa.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('siswa.articles.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Judul Artikel *</label>
                        <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori *</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar Artikel</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konten Artikel *</label>
                        <textarea name="content" class="form-control" rows="15" required>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Kirim untuk Review
                        </button>
                        <button type="button" class="btn btn-outline-secondary" onclick="history.back()">
                            <i class="fas fa-times"></i> Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Panduan Menulis</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-check text-success"></i>
                        <strong>Judul yang Menarik:</strong> Buat judul yang informatif dan menarik perhatian
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success"></i>
                        <strong>Pilih Kategori:</strong> Sesuaikan dengan topik artikel Anda
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success"></i>
                        <strong>Gambar Pendukung:</strong> Tambahkan gambar yang relevan dengan artikel
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success"></i>
                        <strong>Konten Berkualitas:</strong> Tulis dengan bahasa yang jelas dan mudah dipahami
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success"></i>
                        <strong>Periksa Ejaan:</strong> Pastikan tidak ada kesalahan penulisan
                    </li>
                </ul>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5>Proses Review</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="badge bg-warning me-2">1</div>
                    <small>Artikel dikirim untuk review</small>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <div class="badge bg-info me-2">2</div>
                    <small>Admin melakukan review</small>
                </div>
                <div class="d-flex align-items-center">
                    <div class="badge bg-success me-2">3</div>
                    <small>Artikel disetujui dan dipublikasi</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection