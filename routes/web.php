<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Redirect root to home
Route::get('/', function() {
    return redirect('/home.php');
});

// Public routes
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/kategori/{id}', [HomeController::class, 'kategori'])->name('kategori');
Route::get('/artikel/{id}', [HomeController::class, 'show'])->name('artikel.show');



// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Like route (can be used by guests)
Route::post('/artikel/{id}/like', [App\Http\Controllers\ArtikelController::class, 'like'])->name('artikel.like');

// Test artikel create route
Route::get('/create-artikel', function() {
    $kategori = \App\Models\Kategori::all();
    return view('artikel.create', compact('kategori'));
})->name('artikel.create');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function() {
        $user = auth()->user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'guru') {
            return redirect()->route('guru.dashboard');
        } elseif ($user->role === 'siswa') {
            return redirect()->route('siswa.dashboard');
        }
        // Fallback ke dashboard umum jika role tidak dikenali
        return app(App\Http\Controllers\DashboardController::class)->index();
    })->name('dashboard');
    
    // Test route
    Route::get('/test-create', function() {
        return view('test-create');
    })->name('test.create');
    
    // Article routes
    Route::post('/artikel', [App\Http\Controllers\ArtikelController::class, 'store'])->name('artikel.store');
    Route::get('/artikel/{id}/edit', [App\Http\Controllers\ArtikelController::class, 'edit'])->name('artikel.edit');
    Route::put('/artikel/{id}', [App\Http\Controllers\ArtikelController::class, 'update'])->name('artikel.update');
    Route::delete('/artikel/{id}', [App\Http\Controllers\ArtikelController::class, 'destroy'])->name('artikel.destroy');
    
    // Notification routes
    Route::get('/notifications/recent', [App\Http\Controllers\NotificationController::class, 'getRecent'])->name('notifications.recent');
    Route::get('/notifications/count', [App\Http\Controllers\NotificationController::class, 'getUnreadCount'])->name('notifications.count');
    Route::post('/notifications/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    
    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/approvals', [\App\Http\Controllers\ApprovalController::class, 'index'])->name('approvals');
        Route::post('/approvals/{id}/approve', [\App\Http\Controllers\ApprovalController::class, 'approve'])->name('approvals.approve');
        Route::post('/approvals/{id}/reject', [\App\Http\Controllers\ApprovalController::class, 'reject'])->name('approvals.reject');
        Route::get('/categories', function() { return view('admin.categories'); })->name('categories');
    });
    
    // Guru routes
    Route::prefix('guru')->name('guru.')->group(function () {
        Route::get('/dashboard', function() { return view('guru.dashboard'); })->name('dashboard');
    });
    

    
    // Siswa routes
    Route::prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/dashboard', function() { return view('siswa.dashboard'); })->name('dashboard');
    });
    
    // User status route
    Route::get('/my-articles-status', function() {
        return view('notifications.user-status');
    })->name('user.articles.status');
    
    // User articles management
    Route::get('/my-articles', [\App\Http\Controllers\UserArtikelController::class, 'index'])->name('user.articles');
});