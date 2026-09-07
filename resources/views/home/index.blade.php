@extends('layouts.app')

@section('title', $header->title ?? 'Semanario Loretano - Iquitos')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
@include('partials.sidebar-styles')
<style>
    .sl-cover-story {
        position: relative;
        min-height: 500px;
        border-radius: 5px;
        overflow: hidden;
        background: #123;
        box-shadow: 0 3px 15px rgba(0,0,0,.12);
    }

    .sl-cover-story > img {
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .sl-cover-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,.03) 25%, rgba(0,0,0,.88) 100%);
    }

    .sl-cover-label {
        position: absolute;
        top: 18px;
        left: 18px;
        background: #e21e25;
        color: white;
        font-weight: 800;
        padding: 9px 14px;
        border-radius: 4px;
        font-size: 14px;
    }

    .sl-cover-content {
        position: absolute;
        bottom: 30px;
        left: 28px;
        right: 28px;
        color: white;
    }

    .sl-cover-content h2 {
        font-family: "Playfair Display", Georgia, serif;
        font-size: clamp(26px, 3vw, 42px);
        line-height: 1.1;
        font-weight: 800;
        max-width: 900px;
        text-shadow: 0 2px 5px #000;
    }

    .sl-cover-content p {
        max-width: 850px;
        margin: 14px 0 18px;
        font-size: 15px;
        text-shadow: 0 1px 3px #000;
    }

    .sl-read-button {
        display: inline-block;
        background: #f21e2b;
        color: white;
        padding: 13px 20px;
        border-radius: 4px;
        font-weight: 800;
        text-decoration: none;
    }

    .sl-latest-grid {
        background: white;
        margin-top: 16px;
        padding: 18px;
        border-radius: 5px;
    }

    .sl-content-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid #0c6545;
        padding-bottom: 9px;
        margin-bottom: 14px;
    }

    .sl-content-heading h2 { font-size: 19px; margin: 0; }
    .sl-content-heading a { color: #0c6545; font-size: 12px; font-weight: 800; text-decoration: none; }

    .sl-news-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }

    .sl-news-card {
        display: grid;
        grid-template-columns: 135px 1fr;
        gap: 13px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 13px;
        cursor: pointer;
    }

    .sl-news-card img { width: 135px; height: 110px; object-fit: cover; border-radius: 4px; }
    .sl-news-card span { font-size: 10px; color: #16803e; font-weight: 800; }
    .sl-news-card h3 { font-size: 15px; line-height: 1.15; margin: 4px 0; }
    .sl-news-card p { font-size: 11px; color: #65716c; }
    .sl-news-card a { display: block; margin-top: 5px; color: #0c6545; font-size: 11px; font-weight: 800; text-decoration: none; }

    @media (max-width: 1150px) {
        .sl-cover-story { min-height: 420px; }
    }

    @media (max-width: 800px) {
        .sl-cover-story { min-height: 380px; }
        .sl-cover-content { left: 18px; right: 18px; bottom: 25px; }
        .sl-news-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
@php
    $coverNews = $featuredNews->first() ?? $latestNews->first();
    $gridNews = $latestNews->reject(fn ($news) => $coverNews && $news->id === $coverNews->id)->take(4);
@endphp

<div class="sl-page-container">

    <!-- COLUMNA IZQUIERDA -->
    @include('partials.sidebar-left')

    <!-- PORTADA CENTRAL -->
    <section class="sl-main-column">
        @if($coverNews)
            <article class="sl-cover-story">
                @if($coverNews->image)
                    <img src="{{ asset('storage/' . $coverNews->image) }}" alt="{{ $coverNews->title }}">
                @else
                    <img src="https://via.placeholder.com/1600x900/003d2b/FFFFFF?text=Semanario+Loretano" alt="{{ $coverNews->title }}">
                @endif
                <div class="sl-cover-overlay"></div>
                <span class="sl-cover-label">PORTADA DE LA SEMANA</span>

                <div class="sl-cover-content">
                    <h2>{{ $coverNews->title }}</h2>
                    <p>{{ Str::limit($coverNews->summary, 200) }}</p>
                    <a class="sl-read-button" href="{{ route('news.show', $coverNews) }}">Leer artículo completo →</a>
                </div>
            </article>
        @endif

        <section class="sl-latest-grid">
            <div class="sl-content-heading">
                <h2>LO ÚLTIMO</h2>
                <a href="{{ route('news.public') }}">Ver todas →</a>
            </div>

            <div class="sl-news-grid">
                @forelse($gridNews as $news)
                    <article class="sl-news-card" onclick="window.location='{{ route('news.show', $news) }}'">
                        @if($news->image)
                            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}">
                        @else
                            <img src="https://via.placeholder.com/270x220/235347/FFFFFF?text=Noticia" alt="{{ $news->title }}">
                        @endif
                        <div>
                            @if($news->category)
                                <span>{{ Str::upper($news->category) }}</span>
                            @endif
                            <h3>{{ $news->title }}</h3>
                            <p>{{ Str::limit($news->summary, 90) }}</p>
                            <a href="{{ route('news.show', $news) }}">Leer noticia →</a>
                        </div>
                    </article>
                @empty
                    <p class="text-muted mb-0">Aún no hay más noticias publicadas.</p>
                @endforelse
            </div>
        </section>
    </section>

    <!-- COLUMNA DERECHA -->
    @include('partials.sidebar-right')

</div>


<!-- PIE DE PÁGINA -->
<footer class="mt-4 py-3 rounded" style="background: #003d2b; color: white;">
    <div class="container text-center">
        <small>© {{ date('Y') }} {{ $header->title ?? 'Semanario Loretano' }} | Iquitos – Loreto | Contacto: info@semanarioloretano.com</small>
    </div>
</footer>
@endsection