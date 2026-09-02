@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('styles')
<style>
    .login-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f5f0eb 0%, #e8ede4 100%);
    }
    
    .login-card {
        max-width: 420px;
        width: 100%;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 15px 50px rgba(0,0,0,0.1);
        background: white;
    }
    
    .login-card .logo {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .login-card .logo h2 {
        font-family: 'Playfair Display', serif;
        color: var(--primary-green);
    }
</style>
@endsection

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="logo">
            <i class="bi bi-newspaper" style="font-size: 3rem; color: var(--primary-green);"></i>
            <h2>Semanario Loretano</h2>
            <p class="text-muted">Accede al panel de administración</p>
        </div>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle"></i> {{ $errors->first() }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Recordarme</label>
            </div>
            
            <button type="submit" class="btn btn-gold w-100 py-2">
                <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
            </button>
        </form>
        
        <div class="mt-3 text-center">
            <small class="text-muted">
                Credenciales por defecto:<br>
                Email: admin@admin.com<br>
                Contraseña: password
            </small>
        </div>
    </div>
</div>
@endsection