@extends('layouts.app')

@section('title', $news->title)

@section('styles')
<style>
    .news-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 15px 0;
    }
    
    .news-content p {
        line-height: 1.8;
        font-size: 1.05rem;
    }
    
    .news-meta {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Navegación -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $news->title }}</li>
                </ol>
            </nav>

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <!-- Meta información -->
                    <div class="news-meta d-flex flex-wrap align-items-center gap-2">
                        @if($news->category)
                            <span class="badge bg-info text-dark">{{ $news->category }}</span>
                        @endif
                        <span class="badge bg-light text-dark">
                            <i class="bi bi-calendar3"></i> 
                            {{ $news->published_at ? $news->published_at->format('d/m/Y H:i') : 'Sin publicar' }}
                        </span>
                        @if($news->is_featured)
                            <span class="badge bg-danger">
                                <i class="bi bi-star-fill"></i> Destacada
                            </span>
                        @endif
                    </div>

                    <!-- Título -->
                    <h1 class="fw-bold mb-3 display-5">{{ $news->title }}</h1>

                    <!-- Imagen -->
                    @if($news->image)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $news->image) }}" 
                                 class="img-fluid rounded w-100" 
                                 alt="{{ $news->title }}" 
                                 style="max-height: 450px; object-fit: cover;">
                        </div>
                    @endif

                    <!-- Resumen destacado -->
                    <div class="bg-soft-green p-4 rounded-3 mb-4 border-start border-4 border-warning">
                        <h6 class="fw-bold text-uppercase small text-muted mb-2">📌 Resumen</h6>
                        <p class="mb-0 fst-italic">{{ $news->summary }}</p>
                    </div>

                    <!-- Contenido completo -->
                    <div class="news-content">
                        {!! nl2br(e($news->content)) !!}
                    </div>

                    <!-- Compartir (opcional) -->
                    <div class="mt-4 pt-3 border-top">
                        <h6 class="text-muted">Compartir:</h6>
                        <div class="d-flex gap-2">
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($news->title) }}&url={{ urlencode(url()->current()) }}" 
                               target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-twitter"></i> Twitter
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                               target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-facebook"></i> Facebook
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($news->title . ' - ' . url()->current()) }}" 
                               target="_blank" class="btn btn-outline-success btn-sm">
                                <i class="bi bi-whatsapp"></i> WhatsApp
                            </a>
                        </div>
                    </div>

                    <!-- Acciones admin -->
                    @auth
                        <div class="mt-4 pt-3 border-top">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('news.edit', $news) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <form action="{{ route('news.destroy', $news) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" 
                                            onclick="return confirm('¿Estás seguro de eliminar esta noticia?')">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth

                    <!-- Botón volver -->
                    <div class="mt-3">
                        <a href="{{ route('home') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Volver al inicio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection