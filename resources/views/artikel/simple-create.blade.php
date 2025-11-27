<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Buat Artikel Baru</h2>
        
        <form method="POST" action="{{ route('artikel.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="judul" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="id_kategori" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    @foreach(\App\Models\Kategori::all() as $kat)
                        <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Foto</label>
                <input type="file" name="foto" class="form-control" accept="image/*">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Isi Artikel</label>
                <textarea name="isi" class="form-control" rows="10" required></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>