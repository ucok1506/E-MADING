<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>@yield('title', 'E-Mading SMK BAKNUS 666')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #64748b;
            --accent-color: #f59e0b;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
        }
        
        * { font-family: 'Poppins', sans-serif; }
        
        body { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .navbar-brand { font-weight: 700; font-size: 1.5rem; }
        .navbar { backdrop-filter: blur(10px); background: rgba(255,255,255,0.95) !important; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
        .navbar .nav-link { font-weight: 500; color: var(--dark-color) !important; transition: all 0.3s; }
        .navbar .nav-link:hover { color: var(--primary-color) !important; transform: translateY(-2px); }
        
        .main-container { 
            background: white; 
            border-radius: 20px; 
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            margin: 2rem auto;
            overflow: hidden;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            padding: 3rem 0;
            text-align: center;
        }
        
        .hero-title { font-size: 3rem; font-weight: 700; margin-bottom: 1rem; }
        .hero-subtitle { font-size: 1.2rem; opacity: 0.9; margin-bottom: 2rem; }
        
        .card-mading {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .card-mading:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        .category-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 10;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }
        
        .featured-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 10;
            background: var(--accent-color);
            color: white;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
        }
        
        .article-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: var(--secondary-color);
        }
        
        .author-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
        
        .stats-bar {
            background: var(--light-color);
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 2rem;
        }
        
        .stat-item {
            text-align: center;
            padding: 1rem;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: var(--secondary-color);
            font-weight: 500;
        }
        
        .search-section {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        
        .btn-primary {
            background: var(--primary-color);
            border: none;
            border-radius: 10px;
            font-weight: 600;
            padding: 0.7rem 1.5rem;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
        }
        
        .floating-btn {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--accent-color);
            color: white;
            border: none;
            font-size: 1.5rem;
            box-shadow: 0 10px 30px rgba(245, 158, 11, 0.3);
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .floating-btn:hover {
            transform: scale(1.1);
            background: #d97706;
        }
        
        .article-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            padding: 2rem;
        }
        
        .article-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s;
            position: relative;
        }
        
        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        .article-image {
            height: 200px;
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            position: relative;
        }
        
        .article-content {
            padding: 1.5rem;
        }
        
        .article-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
            line-height: 1.4;
        }
        
        .article-excerpt {
            color: var(--secondary-color);
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 1rem;
        }
        
        .article-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
        }
        
        .like-btn {
            background: none;
            border: 2px solid var(--danger-color);
            color: var(--danger-color);
            border-radius: 20px;
            padding: 0.3rem 1rem;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        
        .like-btn.liked {
            background: var(--danger-color);
            color: white;
        }
        
        .like-btn:hover {
            transform: scale(1.05);
        }
        
        .bg-purple {
            background-color: #9C27B0 !important;
        }
        
        .text-purple {
            color: #9C27B0 !important;
        }
        
        /* Animation for cards */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .article-card {
            animation: fadeInUp 0.6s ease forwards;
        }
        
        /* Pagination styling */
        .pagination {
            justify-content: center;
        }
        
        .pagination .page-link {
            color: var(--primary-color);
            border: 1px solid #dee2e6;
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 0.375rem;
            margin: 0 0.125rem;
        }
        
        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }
        
        .pagination .page-link:hover {
            color: var(--primary-color);
            background-color: #e9ecef;
            border-color: #dee2e6;
        }
        
        /* Fix large pagination arrows */
        .pagination .page-link svg {
            width: 1rem !important;
            height: 1rem !important;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-title { font-size: 2rem; }
            .article-grid { grid-template-columns: 1fr; padding: 1rem; }
            .stats-bar .row { text-align: center; }
            .floating-btn { bottom: 1rem; right: 1rem; }
            .pagination .page-link { padding: 0.375rem 0.5rem; font-size: 0.75rem; }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <div class="bg-primary rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="fas fa-newspaper text-white"></i>
                </div>
                <div>
                    <div class="fw-bold text-primary">E-Mading</div>
                    <small class="text-muted" style="font-size: 0.7rem;">SMK BAKNUS 666</small>
                </div>
            </a>
            
            <div class="navbar-nav ms-auto d-flex flex-row gap-3">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-home me-1"></i> Beranda
                </a>
                @auth
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                    </a>
                    <a class="nav-link" href="{{ route('mading.index') }}">
                        <i class="fas fa-newspaper me-1"></i> Artikel Saya
                    </a>
                    <a class="nav-link" href="{{ route('mading.create') }}">
                        <i class="fas fa-plus me-1"></i> Tulis
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-decoration-none">
                            <i class="fas fa-sign-out-alt me-1"></i> Keluar
                        </button>
                    </form>
                @else
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div style="margin-top: 80px;">
        <div class="container">
            <div class="main-container">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Floating Action Button -->
    @auth
        <a href="{{ route('mading.create') }}" class="floating-btn" title="Tulis Artikel Baru">
            <i class="fas fa-pen"></i>
        </a>
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>