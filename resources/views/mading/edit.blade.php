<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artikel - E-Mading SMK BAKNUS 666</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-newspaper me-2"></i>E-Mading SMK
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    @php $categories = \App\Models\Category::all(); @endphp
                    @foreach($categories as $cat)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category', $cat->slug) }}">{{ $cat->name }}</a>
                    </li>
                    @endforeach
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link text-white">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Edit Mading</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('mading.update', $mading) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title', $mading->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                            <option value="">Pilih Kategori</option>
                            @php $categories = \App\Models\Category::all(); @endphp
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $mading->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Konten</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" name="content" rows="8" required>{{ old('content', $mading->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="publish" name="publish" value="1" 
                                       {{ old('publish', $mading->status == 'published') ? 'checked' : '' }}>
                                <label class="form-check-label" for="publish">
                                    <i class="fas fa-eye"></i> Publikasikan sekarang
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1" 
                                       {{ old('is_featured', $mading->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">
                                    <i class="fas fa-star"></i> Jadikan artikel unggulan
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Artikel
                            </button>
                            <a href="{{ route('mading.show', $mading) }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <div>
                            <form action="{{ route('mading.destroy', $mading) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus artikel ini? Tindakan ini tidak dapat dibatalkan!')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Hapus Artikel
                                </button>
                            </form>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>