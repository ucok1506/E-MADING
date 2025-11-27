<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Mading SMK - Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="home.php">
                <i class="fas fa-newspaper me-2"></i>E-Mading SMK
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="home.php">Beranda</a>
                    </li>

                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/login">
                            <i class="fas fa-sign-in-alt me-1"></i>Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-primary text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">E-Mading SMK</h1>
                    <p class="lead mb-4">Platform digital untuk berbagi informasi, artikel, dan kreativitas siswa SMK. Temukan berita terbaru, prestasi, dan kegiatan sekolah di sini.</p>
                    <a href="#artikel" class="btn btn-light btn-lg">
                        <i class="fas fa-newspaper me-2"></i>Lihat Artikel
                    </a>

                </div>
                <div class="col-lg-6 text-center">
                    <i class="fas fa-graduation-cap" style="font-size: 200px; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Artikel Terbaru -->
    <section id="artikel" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Artikel Terbaru</h2>
            
            <!-- Search Form -->
            <div class="row mb-4">
                <div class="col-md-6 mx-auto">
                    <form method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control me-2" placeholder="Cari artikel..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="row" id="articleContainer">
                <?php
                try {
                    $host = '127.0.0.1';
                    $dbname = 'mading_db';
                    $username = 'root';
                    $password = '';
                    
                    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    // Pagination
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $limit = 6;
                    $offset = ($page - 1) * $limit;
                    
                    // Search
                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                    $searchCondition = '';
                    $params = [];
                    
                    if (!empty($search)) {
                        $searchCondition = " AND (judul LIKE ? OR isi LIKE ?)";
                        $params = ["%$search%", "%$search%"];
                    }
                    
                    // Get total count
                    $countStmt = $pdo->prepare("SELECT COUNT(*) FROM artikel WHERE status = 'publish'" . $searchCondition);
                    $countStmt->execute($params);
                    $totalArticles = $countStmt->fetchColumn();
                    $totalPages = ceil($totalArticles / $limit);
                    
                    // Get articles
                    $stmt = $pdo->prepare("SELECT * FROM artikel WHERE status = 'publish'" . $searchCondition . " ORDER BY tanggal DESC LIMIT $limit OFFSET $offset");
                    $stmt->execute($params);
                    $articles = $stmt->fetchAll();
                    
                    if (empty($articles)) {
                        echo '<div class="col-12 text-center"><p class="text-muted">Belum ada artikel yang dipublikasi.</p></div>';
                    } else {
                        foreach ($articles as $article) {
                            echo '<div class="col-md-4 mb-4">';
                            echo '<div class="card h-100">';
                            if ($article['foto']) {
                                $imagePath = null;
                                $paths = [
                                    'uploads/' . $article['foto'],
                                    'uploads/' . basename($article['foto']),
                                    $article['foto']
                                ];
                                foreach($paths as $path) {
                                    if(file_exists($path)) {
                                        $imagePath = $path;
                                        break;
                                    }
                                }
                                if ($imagePath) {
                                    echo '<img src="' . $imagePath . '" class="card-img-top" style="height: 200px; object-fit: cover;">';
                                }
                            }
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . htmlspecialchars($article['judul']) . '</h5>';
                            echo '<p class="card-text">' . htmlspecialchars(substr(strip_tags($article['isi']), 0, 100)) . '...</p>';
                            echo '<div class="d-flex justify-content-between align-items-center">';
                            echo '<small class="text-muted">' . date('d M Y', strtotime($article['tanggal'])) . '</small>';
                            
                            // Get like count
                            $like_stmt = $pdo->prepare("SELECT COUNT(*) as total FROM `like` WHERE id_artikel = ?");
                            $like_stmt->execute([$article['id_artikel']]);
                            $like_count = $like_stmt->fetch()['total'] ?? 0;
                            
                            echo '<button class="btn btn-sm btn-outline-danger like-btn" data-artikel-id="' . $article['id_artikel'] . '">';
                            echo '<i class="fas fa-heart"></i> ' . $like_count;
                            echo '</button>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                } catch (Exception $e) {
                    echo '<div class="col-12 text-center"><p class="text-danger">Error loading articles</p></div>';
                }
                ?>
            </div>
            
            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
            <div class="row mt-4">
                <div class="col-12">
                    <nav>
                        <ul class="pagination justify-content-center">
                            <?php if ($page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $page-1; ?><?php echo !empty($search) ? '&search='.urlencode($search) : ''; ?>">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?><?php echo !empty($search) ? '&search='.urlencode($search) : ''; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php endfor; ?>
                            
                            <?php if ($page < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $page+1; ?><?php echo !empty($search) ? '&search='.urlencode($search) : ''; ?>">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Tentang -->
    <section id="tentang" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2>Tentang E-Mading SMK</h2>
                    <p>E-Mading adalah platform digital yang menggantikan mading konvensional dengan sistem yang lebih modern dan interaktif. Siswa, guru, dan admin dapat berbagi informasi sekolah secara online.</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i>Artikel dari siswa dan guru</li>
                        <li><i class="fas fa-check text-success me-2"></i>Informasi kegiatan sekolah</li>
                        <li><i class="fas fa-check text-success me-2"></i>Prestasi dan pencapaian</li>
                        <li><i class="fas fa-check text-success me-2"></i>Opini dan kreativitas</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <i class="fas fa-users fa-2x text-primary mb-2"></i>
                                    <h5>Siswa</h5>
                                    <p class="small">Berbagi kreativitas dan opini</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <i class="fas fa-chalkboard-teacher fa-2x text-success mb-2"></i>
                                    <h5>Guru</h5>
                                    <p class="small">Informasi dan edukasi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>E-Mading SMK</h5>
                    <p>Platform digital untuk berbagi informasi sekolah</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>&copy; 2024 SMK. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.like-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const artikelId = this.dataset.artikelId;
                
                fetch('like-artikel.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `artikel_id=${artikelId}&user_id=1`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.innerHTML = `<i class="fas fa-heart"></i> ${data.total}`;
                        this.classList.toggle('btn-danger', data.liked);
                        this.classList.toggle('btn-outline-danger', !data.liked);
                    }
                });
            });
        });
        

        


    </script>
</body>
</html>