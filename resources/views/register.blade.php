<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - E-Mading SMK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .register-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        .register-title {
            color: white;
            font-size: 2rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
        }
        
        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            color: white;
            padding: 12px 15px;
            margin-bottom: 15px;
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        
        .form-control:focus, .form-select:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
            color: white;
        }
        
        .form-select option {
            background: #333;
            color: white;
        }
        
        .btn-register {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            border-radius: 10px;
            padding: 12px;
            width: 100%;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-register:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            transform: translateY(-2px);
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }
        
        .login-link a {
            color: white;
            text-decoration: none;
            font-weight: 600;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        .alert {
            background: rgba(220, 53, 69, 0.2);
            border: 1px solid rgba(220, 53, 69, 0.3);
            color: white;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2 class="register-title">Daftar Akun</h2>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        
        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}" required>
            </div>
            
            <div class="mb-3">
                <input type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}" required>
            </div>
            
            <div class="mb-3">
                <select name="role" class="form-select" required>
                    <option value="">Pilih Role</option>
                    <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                    <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                </select>
            </div>
            
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password (min. 6 karakter)" required>
            </div>
            
            <div class="mb-3">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password" required>
            </div>
            
            <button type="submit" class="btn btn-register">
                <i class="fas fa-user-plus me-2"></i>Daftar
            </button>
        </form>
        
        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
        </div>
    </div>
</body>
</html>