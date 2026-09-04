@extends('layouts.admin')

@section('title', 'Dashboard - Semanario Loretano')

@section('admin-content')
<h4 class="mb-4">Bienvenido, {{ auth()->user()->name ?? 'Usuario' }} 👋</h4>
        
        <div class="row g-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <h6 class="text-muted">Total Noticias</h6>
                    <h2 class="fw-bold text-primary">{{ \App\Models\News::count() }}</h2>
                    <a href="{{ route('news.index') }}" class="text-decoration-none">Ver todas</a>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="stat-card" style="border-left-color: #e74c3c;">
                    <h6 class="text-muted">Publicidad Activa</h6>
                    <h2 class="fw-bold text-danger">{{ \App\Models\Advertisement::where('is_active', true)->count() }}</h2>
                    <a href="{{ route('advertisements.index') }}" class="text-decoration-none">Gestionar</a>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="stat-card" style="border-left-color: #f39c12;">
                    <h6 class="text-muted">Encabezado</h6>
                    <h2 class="fw-bold text-warning">✏️</h2>
                    <a href="{{ route('header.edit') }}" class="text-decoration-none">Editar encabezado</a>
                </div>
            </div>
        </div>
        
        <!-- Acciones rápidas -->
        <div class="card mt-4 shadow-sm">
            <div class="card-header bg-white">
                <h6 class="mb-0"><i class="bi bi-lightning"></i> Acciones Rápidas</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <a href="{{ route('news.create') }}" class="btn btn-outline-primary w-100 py-3">
                            <i class="bi bi-plus-circle"></i><br>
                            Nueva Noticia
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('advertisements.create') }}" class="btn btn-outline-success w-100 py-3">
                            <i class="bi bi-plus-circle"></i><br>
                            Nueva Publicidad
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('header.edit') }}" class="btn btn-outline-warning w-100 py-3">
                            <i class="bi bi-pencil"></i><br>
                            Editar Encabezado
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary w-100 py-3">
                            <i class="bi bi-people"></i><br>
                            Gestionar Usuarios
                        </a>
                    </div>
                </div>
            </div>
</div>
@endsection