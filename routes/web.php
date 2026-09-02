<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\HeaderController;

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

// CRUD Publicidad
Route::resource('advertisements', AdvertisementController::class);

// CRUD Encabezado
Route::get('/header/edit', [HeaderController::class, 'edit'])->name('header.edit');
Route::put('/header/update', [HeaderController::class, 'update'])->name('header.update');

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