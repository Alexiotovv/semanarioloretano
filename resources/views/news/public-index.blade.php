@extends('layouts.app')

@section('title', 'Todas las noticias')

@section('styles')
<style>
    .public-news-meta {
        min-width: 0;
    }

    .public-news-meta .badge {
        max-width: 100%;
        overflow-wrap: anywhere;
        white-space: normal;
    }

    .public-news-meta small {
        white-space: nowrap;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h1 class="h3 mb-1"><i class="bi bi-newspaper"></i> Todas las noticias</h1>
            <p class="text-muted mb-0">Información y actualidad de la ciudad de Iquitos</p>
        </div>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver al inicio
        </a>
    </div>

    @if($news->isNotEmpty())
        <div class="row g-4">
            @foreach($news as $item)
                <div class="col-md-6 col-xl-4">
                    <article class="card h-100 shadow-sm border-0">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}"
                                 class="card-img-top"
                                 alt="{{ $item->title }}"
                                 style="height: 210px; object-fit: cover; object-position: top center;">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light text-muted"
                                 style="height: 210px;">
                                <i class="bi bi-newspaper" style="font-size: 3rem;"></i>
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column">
                            <div class="public-news-meta d-flex flex-wrap align-items-center gap-1 mb-2">
                                @if($item->category)
                                    <span class="badge bg-info text-dark">{{ $item->category }}</span>
                                @endif
                                <small class="text-muted">
                                    {{ $item->published_at->format('d/m/Y') }}
                                </small>
                            </div>
                            <h2 class="h5 card-title">{{ $item->title }}</h2>
                            <p class="card-text text-muted">{{ Str::limit($item->summary, 150) }}</p>
                            <a href="{{ route('news.show', $item) }}" class="btn btn-outline-primary mt-auto align-self-start">
                                <i class="bi bi-eye"></i> Leer noticia
                            </a>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $news->withQueryString()->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-newspaper text-muted" style="font-size: 4rem;"></i>
            <h2 class="h4 mt-3">Aún no hay noticias publicadas</h2>
            <p class="text-muted">Vuelve pronto para consultar las novedades.</p>
        </div>
    @endif
</div>
@endsection
