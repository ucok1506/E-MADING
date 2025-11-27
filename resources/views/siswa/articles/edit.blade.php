@extends('layouts.siswa')

@section('title', 'Edit Artikel')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Edit Artikel</h2>
            <a href="{{ route('siswa.articles.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('siswa.articles.update', $article->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">Judul Artikel *</label>
                        <input type="text" name="title" class="form-control" required value="{{ old('title', $article->title) }}">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori *</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
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
                        @if($article->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $article->image) }}" class="img-thumbnail" style="max-height: 150px;" alt="Current image">
                                <p class="small text-muted">Gambar saat ini</p>
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.</small>
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konten Artikel *</label>
                        <textarea name="content" class="form-control" rows="15" required>{{ old('content', $article->content) }}</textarea>
                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('siswa.articles.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Status Artikel</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <span class="badge bg-{{ $article->status === 'published' ? 'success' : ($article->status === 'pending' ? 'warning' : 'secondary') }} me-2">
                        {{ ucfirst($article->status) }}
                    </span>
                    <span class="text-muted">
                        @if($article->status === 'published')
                            Artikel telah dipublikasi
                        @elseif($article->status === 'pending')
                            Menunggu persetujuan admin
                        @else
                            Draft
                        @endif
                    </span>
                </div>
                
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border rounded p-2">
                            <h6 class="mb-1">{{ $article->likes_count ?? 0 }}</h6>
                            <small class="text-muted">Likes</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="border rounded p-2">
                            <h6 class="mb-1">{{ $article->views ?? 0 }}</h6>
                            <small class="text-muted">Views</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5>Informasi</h5>
            </div>
            <div class="card-body">
                <p class="small mb-2"><strong>Dibuat:</strong> {{ $article->created_at->format('d M Y H:i') }}</p>
                <p class="small mb-2"><strong>Diperbarui:</strong> {{ $article->updated_at->format('d M Y H:i') }}</p>
                <p class="small mb-0"><strong>Kategori:</strong> {{ $article->category->name ?? 'Tidak ada' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection