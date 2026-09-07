@extends('layouts.app')

@section('title', $header->title ?? 'Semanario Loretano - Iquitos')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<style>
    .sl-page-container {
        max-width: 1500px;
        margin: 16px auto;
        display: grid;
        grid-template-columns: 320px minmax(0, 1fr) 350px;
        gap: 16px;
        padding: 0 12px;
        font-family: "Montserrat", Arial, sans-serif;
    }

    .sl-left-column, .sl-right-column { display: flex; flex-direction: column; gap: 16px; }

    .sl-side-card {
        background: white;
        border: 1px solid #dfe4df;
        box-shadow: 0 2px 10px rgba(0,0,0,.05);
        border-radius: 4px;
        overflow: hidden;
    }

    .sl-section-title {
        color: white;
        padding: 13px 16px;
        font-size: 17px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sl-section-title b { margin-left: auto; font-size: 26px; }
    .sl-section-title.green { background: linear-gradient(90deg, #247d18, #116209); }
    .sl-section-title.blue { background: linear-gradient(90deg, #1773a0, #14567b); }

    .sl-mini-article {
        display: grid;
        grid-template-columns: 105px 1fr;
        gap: 13px;
        padding: 13px;
    }

    .sl-mini-article img {
        width: 105px;
        height: 125px;
        object-fit: cover;
        border-radius: 4px;
    }

    .sl-mini-article h3 { font-size: 17px; line-height: 1.15; margin-bottom: 7px; }
    .sl-mini-article p { color: #52615b; font-size: 13px; }
    .sl-mini-article a { display: inline-block; margin-top: 9px; color: #14752d; font-weight: 800; font-size: 13px; }

    .sl-main-column { min-width: 0; }

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

    .sl-content-heading, .sl-right-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid #0c6545;
        padding-bottom: 9px;
        margin-bottom: 14px;
    }

    .sl-content-heading h2, .sl-right-title h2 { font-size: 19px; margin: 0; }
    .sl-content-heading a, .sl-right-title a { color: #0c6545; font-size: 12px; font-weight: 800; text-decoration: none; }

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

    .sl-right-title { padding: 5px 4px 10px; }
    .sl-right-title h2 { color: #17231f; }

    .sl-right-news {
        display: grid;
        grid-template-columns: 100px 1fr;
        gap: 12px;
        padding: 11px 4px;
        border-bottom: 1px solid #e4e7e5;
        cursor: pointer;
    }

    .sl-right-news img { width: 100px; height: 72px; object-fit: cover; border-radius: 4px; }
    .sl-right-news h3 { font-size: 13px; line-height: 1.2; margin: 0; }
    .sl-right-news small { display: block; margin-top: 5px; color: #727b77; font-size: 9px; }

    .sl-latest-card { padding: 10px 12px; }

    .sl-advertising {
        background: linear-gradient(135deg, #e2f3e7, #c9e3d0);
        border-radius: 5px;
        padding: 22px;
        text-align: center;
        color: #064832;
        border: 1px solid #b4d5bf;
    }

    .sl-advertising img { max-width: 100%; border-radius: 4px; }
    .sl-advertising .sl-ad-icon { font-size: 35px; }
    .sl-advertising h2 { font-size: 18px; margin: 5px 0; }
    .sl-advertising p { font-size: 12px; margin-bottom: 14px; }
    .sl-advertising a {
        display: inline-block;
        background: #003d2b;
        color: white;
        padding: 10px 20px;
        border-radius: 4px;
        font-weight: 800;
        font-size: 13px;
        text-decoration: none;
    }

    @media (max-width: 1150px) {
        .sl-page-container { grid-template-columns: 250px minmax(0, 1fr); }
        .sl-right-column { display: none; }
        .sl-cover-story { min-height: 420px; }
    }

    @media (max-width: 800px) {
        .sl-page-container { display: block; padding: 0 8px; }
        .sl-left-column, .sl-main-column { margin-bottom: 16px; }
        .sl-cover-story { min-height: 380px; }
        .sl-cover-content { left: 18px; right: 18px; bottom: 25px; }
        .sl-news-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
@php
    $analysisSection = $sections->first(fn ($section) => str_contains(mb_strtolower($section->title), 'anali'));
    $techSection = $sections->first(fn ($section) => str_contains(mb_strtolower($section->title), 'tecno'));
    $coverNews = $featuredNews->first() ?? $latestNews->first();
    $gridNews = $latestNews->reject(fn ($news) => $coverNews && $news->id === $coverNews->id)->take(4);
@endphp

<div class="sl-page-container">

    <!-- COLUMNA IZQUIERDA -->
    <aside class="sl-left-column">
        @if($analysisSection && $analysisSection->news->isNotEmpty())
            @php($analysisNews = $analysisSection->news->first())
            <section class="sl-side-card">
                <div class="sl-section-title green">
                    <span>▣</span> ANALIZANDO
                    <a href="{{ route('sections.show', $analysisSection) }}" style="color:white;"><b>›</b></a>
                </div>
                <article class="sl-mini-article">
                    @if($analysisNews->image)
                        <img src="{{ asset('storage/' . $analysisNews->image) }}" alt="{{ $analysisNews->title }}">
                    @else
                        <img src="https://via.placeholder.com/210x250/0c6545/FFFFFF?text=Analisis" alt="{{ $analysisNews->title }}">
                    @endif
                    <div>
                        <h3>{{ $analysisNews->title }}</h3>
                        <p>{{ Str::limit($analysisNews->summary, 100) }}</p>
                        <a href="{{ route('news.show', $analysisNews) }}">Leer más →</a>
                    </div>
                </article>
            </section>
        @endif

        @if($techSection && $techSection->news->isNotEmpty())
            @php($techNews = $techSection->news->first())
            <section class="sl-side-card">
                <div class="sl-section-title blue">
                    <span>▣</span> TECNOLOGÍA
                    <a href="{{ route('sections.show', $techSection) }}" style="color:white;"><b>›</b></a>
                </div>
                <article class="sl-mini-article">
                    @if($techNews->image)
                        <img src="{{ asset('storage/' . $techNews->image) }}" alt="{{ $techNews->title }}">
                    @else
                        <img src="https://via.placeholder.com/210x250/17648e/FFFFFF?text=Tecnologia" alt="{{ $techNews->title }}">
                    @endif
                    <div>
                        <h3>{{ $techNews->title }}</h3>
                        <p>{{ Str::limit($techNews->summary, 100) }}</p>
                        <a href="{{ route('news.show', $techNews) }}">Leer más →</a>
                    </div>
                </article>
            </section>
        @endif
    </aside>

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
    <aside class="sl-right-column">
        <section class="sl-side-card sl-latest-card">
            <div class="sl-right-title">
                <h2>▣ &nbsp; ÚLTIMAS NOTICIAS</h2>
                <a href="{{ route('news.public') }}">Ver todas →</a>
            </div>

            @forelse($latestNews as $news)
                <article class="sl-right-news" onclick="window.location='{{ route('news.show', $news) }}'">
                    @if($news->image)
                        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}">
                    @else
                        <img src="https://via.placeholder.com/200x150/235347/FFFFFF?text=Noticia" alt="{{ $news->title }}">
                    @endif
                    <div>
                        <h3>{{ $news->title }}</h3>
                        <small>{{ $news->published_at->translatedFormat('d \d\e F \d\e Y') }}</small>
                    </div>
                </article>
            @empty
                <p class="text-muted mb-0">Aún no hay noticias publicadas.</p>
            @endforelse
        </section>

        @forelse($sidebarAds as $ad)
            <section class="sl-advertising">
                @if($ad->link)
                    <a href="{{ $ad->link }}" target="_blank">
                        @if($ad->image)
                            <img src="{{ asset('storage/' . $ad->image) }}" alt="{{ $ad->title }}">
                        @else
                            <img src="https://via.placeholder.com/300x200/e67e22/FFFFFF?text={{ urlencode($ad->title) }}" alt="{{ $ad->title }}">
                        @endif
                    </a>
                @else
                    @if($ad->image)
                        <img src="{{ asset('storage/' . $ad->image) }}" alt="{{ $ad->title }}">
                    @else
                        <img src="https://via.placeholder.com/300x200/e67e22/FFFFFF?text={{ urlencode($ad->title) }}" alt="{{ $ad->title }}">
                    @endif
                @endif
                <p class="mt-2 mb-0 small">{{ $ad->description ?? $ad->title }}</p>
            </section>
        @empty
            <section class="sl-advertising">
                <div class="sl-ad-icon">📣</div>
                <h2>TU PUBLICIDAD AQUÍ</h2>
                <p>Llega a miles de lectores en toda la región.</p>
                <a href="mailto:publicidad@semanarioloretano.pe">Contáctanos</a>
            </section>
        @endforelse
    </aside>

</div>

<!-- PIE DE PÁGINA -->
<footer class="mt-4 py-3 rounded" style="background: #003d2b; color: white;">
    <div class="container text-center">
        <small>© {{ date('Y') }} {{ $header->title ?? 'Semanario Loretano' }} | Iquitos – Loreto | Contacto: info@semanarioloretano.com</small>
    </div>
</footer>
@endsection