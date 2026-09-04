<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SectionController;

// Página principal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Listado público de noticias
Route::get('/noticias', [NewsController::class, 'publicIndex'])->name('news.public');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// CRUD Noticias
Route::get('/news', [NewsController::class, 'index'])
    ->middleware('auth')
    ->name('news.index');
Route::resource('news', NewsController::class)->except(['index', 'show'])
    ->middleware('auth');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');

// Secciones públicas y administrativas
Route::get('/secciones/{section}', [SectionController::class, 'show'])->name('sections.show');
Route::get('sections/{section}/news', [SectionController::class, 'news'])->middleware('auth')->name('sections.news.index');
Route::resource('sections', SectionController::class)->except(['show'])
    ->middleware('auth');

// CRUD Publicidad
Route::resource('advertisements', AdvertisementController::class);

// CRUD Encabezado
Route::get('/header/edit', [HeaderController::class, 'edit'])->name('header.edit');
Route::put('/header/update', [HeaderController::class, 'update'])->name('header.update');

// CRUD Usuarios
Route::resource('users', UserController::class)
    ->except(['show'])
    ->middleware('auth');

// Rutas de autenticación
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Illuminate\Http\Request $request) {
    $credentials = $request->only('email', 'password');
    
    if (auth()->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }
    
    return back()->withErrors([
        'email' => 'Las credenciales no coinciden con nuestros registros.',
    ]);
});

Route::post('/logout', function (Illuminate\Http\Request $request) {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');