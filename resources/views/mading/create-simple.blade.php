<!DOCTYPE html>
<html>
<head>
    <title>Buat Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Buat Artikel Baru</h2>
        <form action="{{ route('mading.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Judul</label>
                <input type="text" class="form-control" name="title" required>
            </div>
            <div class="mb-3">
                <label>Konten</label>
                <textarea class="form-control" name="content" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label>Kategori</label>
                <select class="form-control" name="category_id" required>
                    <option value="">Pilih Kategori</option>
                    @foreach(\App\Models\Category::all() as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>
</html>