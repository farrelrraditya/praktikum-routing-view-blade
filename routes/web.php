
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ProjectGalleryController;

Route::get('/portfolio', [PortfolioController::class, 'index'])
    ->name('portfolio.index');

Route::get('/projects/{project}', [PortfolioController::class, 'show'])
    ->name('portfolio.projects.show');

// Halaman publik
Route::get('/', [PortfolioController::class, 'index'])
    ->name('home');

// Dashboard setelah login
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('dashboard');

// Route yang wajib login dan memiliki hak admin
Route::prefix('post')
    ->name('post.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::resource('dashboard', DashboardController::class)
        ->only(['index']);
        Route::resource('projects', ProjectController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('technologies', TechnologyController::class);
        Route::resource('skills', SkillController::class)
        ->only(['index', 'edit', 'update']);


        Route::post(
            'projects/{project}/gallery',
            [ProjectGalleryController::class, 'store']
        )->name('projects.gallery.store');

        Route::delete(
            'projects/{project}/gallery/{image}',
            [ProjectGalleryController::class, 'destroy']
        )->name('projects.gallery.destroy');

        Route::put(
            'projects/{project}/gallery/{image}/caption',
            [ProjectGalleryController::class, 'updateCaption']
        )->name('projects.gallery.caption.update');


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
