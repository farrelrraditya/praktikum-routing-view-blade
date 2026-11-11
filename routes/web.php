
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TechnologyController;
use Illuminate\Support\Facades\Route;

// Halaman publik
Route::get('/', [PortfolioController::class, 'index'])
    ->name('home');

// Dashboard setelah login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route yang wajib login dan memiliki hak admin
Route::prefix('post')
    ->name('post.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::resource('projects', ProjectController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('technologies', TechnologyController::class);
    });

require __DIR__.'/auth.php';

// Route untuk pengelolaan profil pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

Route::get('/post/profile-saya', function () {
    return view('posts.profile-saya', [
        'user' => Auth::user(),
    ]);
})->middleware('auth')->name('post.profile-saya');
