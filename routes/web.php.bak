<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::resource('posts', PostController::class);

Route::prefix('portfolio')->group(function() {
    Route::get('/', fn() => view('portfolio.home'))
        ->name('portfolio.home');

    Route::get('/about', fn() => view('portfolio.about'))
        ->name('portfolio.about');

    Route::get('/projects', fn() => view('portfolio.projects'))
        ->name('portfolio.projects');
});

Route::get('/halo-dunia', function() {
    return view('halo_dunia');
});

Route::get('/portfolio', function () {
    return view('portfolio.home');
});

Route::get('/profil', function () {
    $nama = 'Farrel';
    $umur = 19;
    $kota = 'Jogja';

    return view('profil', compact(
        'nama',
        'umur',
        'kota'
    ));
});

Route::get('/halo-blade', function() {
    return view('halo', [
        'data' => 'Contoh data'
    ]);
});

Route::get('/profil', function () {
    $nama = 'Farrel';
    $umur = 20;
    $data = 'kursi';

    return view('profil', compact('nama', 'umur'));
});

Route::get('/projects', function () {
    return view('projects');
})->name('projects');


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/education', function () {
    return view('education');
})->name('education');



