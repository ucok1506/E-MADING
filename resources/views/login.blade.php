<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Mading SMK</title>
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
            position: relative;
            overflow: hidden;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="white" opacity="0.1"/><circle cx="80" cy="40" r="1" fill="white" opacity="0.15"/><circle cx="40" cy="80" r="1.5" fill="white" opacity="0.1"/><circle cx="90" cy="90" r="1" fill="white" opacity="0.2"/><circle cx="10" cy="60" r="1" fill="white" opacity="0.1"/></svg>') repeat;
            animation: float 20s infinite linear;
        }
        
        .login-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2), 0 5px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
            animation: slideUp 0.8s ease-out;
        }
        
        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            border-radius: 25px;
            z-index: -1;
        }
        
        .login-title {
            color: white;
            font-size: 2rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
        }
        
        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            color: white;
            padding: 12px 15px;
            margin-bottom: 20px;
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        
        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
            color: white;
        }
        
        .btn-login {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            border-radius: 10px;
            padding: 12px;
            width: 100%;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-login:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            transform: translateY(-2px);
        }
        
        .form-check-input {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .form-check-label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }
        
        .register-link {
            text-align: center;
            margin-top: 20px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }
        
        .register-link a {
            color: white;
            text-decoration: none;
            font-weight: 600;
        }
        
        .register-link a:hover {
            text-decoration: underline;
        }
        
        .school-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .school-logo img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            animation: pulse 2s infinite;
        }

        .demo-accounts {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            margin-top: 25px;
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
        }
        
        @keyframes float {
            0% { transform: translateX(-100px) translateY(-100px); }
            100% { transform: translateX(100px) translateY(100px); }
        }
        
        @keyframes slideUp {
            0% { transform: translateY(50px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .form-control:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.6);
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.3), 0 0 20px rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
        
        .btn-login:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="school-logo">
            <img src="{{ asset('images/logo-smk.png') }}" alt="Logo SMK">
        </div>
        
        <h2 class="login-title">
            <i class="fas fa-newspaper me-2"></i>E-Mading SMK
        </h2>
        <p class="text-center text-white-50 mb-4">Sistem Informasi Digital Sekolah</p>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}" required>
            </div>
            
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label" for="remember">
                        Ingat saya
                    </label>
                </div>
            </div>
            
            <button type="submit" class="btn btn-login">
                <i class="fas fa-sign-in-alt me-2"></i>Masuk
            </button>
        </form>
        
        <div class="register-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
        </div>
        
        <div class="text-center mt-3">
            <a href="home.php" class="btn btn-outline-light btn-sm">
                <i class="fas fa-arrow-left me-1"></i>Kembali ke Home
            </a>
        </div>


    </div>
</body>
</html>