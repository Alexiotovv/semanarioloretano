@extends('layouts.app')

@section('title', 'Dashboard - Semanario Loretano')

@section('styles')
<style>
    .dashboard-wrapper {
        display: flex;
        min-height: calc(100vh - 72px);
    }
    
    .sidebar-dashboard {
        width: 260px;
        background: white;
        box-shadow: 2px 0 10px rgba(0,0,0,0.05);
        padding: 20px 0;
        flex-shrink: 0;
    }
    
    .sidebar-dashboard .user-info {
        padding: 0 20px 20px;
        border-bottom: 1px solid #eee;
        margin-bottom: 20px;
    }
    
    .sidebar-dashboard .user-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: var(--primary-green);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin: 0 auto 10px;
    }
    
    .main-content {
        flex: 1;
        padding: 30px;
        background: #f8f9fa;
    }
    
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        transition: all 0.3s;
        border-left: 4px solid var(--accent-gold);
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
</style>
@endsection

@section('content')
<div class="dashboard-wrapper">
    <!-- Sidebar -->
    <div class="sidebar-dashboard">
        <div class="user-info text-center">
            <div class="user-avatar">
                <i class="bi bi-person-circle"></i>
            </div>
            <h6 class="mb-0">{{ auth()->user()->name ?? 'Usuario' }}</h6>
            <small class="text-muted">{{ auth()->user()->email ?? '' }}</small>
        </div>
        
        <nav>
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i> Panel Principal
            </a>
            <a href="{{ route('news.index') }}" class="sidebar-link {{ request()->routeIs('news.*') ? 'active' : '' }}">
                <i class="bi bi-newspaper"></i> Noticias
            </a>
            <a href="{{ route('advertisements.index') }}" class="sidebar-link {{ request()->routeIs('advertisements.*') ? 'active' : '' }}">
                <i class="bi bi-image"></i> Publicidad
            </a>
            <a href="{{ route('header.edit') }}" class="sidebar-link {{ request()->routeIs('header.*') ? 'active' : '' }}">
                <i class="bi bi-layout-text-window"></i> Encabezado
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection