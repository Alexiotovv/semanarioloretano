@extends('layouts.app')

@section('title', $header->title ?? 'Semanario Loretano - Iquitos')

@section('styles')
<style>
    .home-news-content {
        min-width: 0;
    }

    .home-news-meta {
        min-width: 0;
    }

    .home-news-meta .badge {
        max-width: 100%;
        overflow-wrap: anywhere;
        white-space: normal;
    }
</style>
@endsection

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Encabezado del Semanario -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 bg-soft-green">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-4 text-center">
                            @if($header && $header->image)
                                <img src="{{ asset('storage/' . $header->image) }}" 
                                     class="img-fluid rounded" 
                                     alt="{{ $header->title }}"
                                     style="max-height: 150px; width: auto;">
                            @else
                                <i class="bi bi-newspaper" style="font-size: 6rem; color: var(--primary-green);"></i>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h1 class="display-4 fw-bold" style="color: var(--primary-green);">
                                {{ $header->title ?? 'Semanario Loretano' }}
                            </h1>
                            @if($header && $header->subtitle)
                                <h4 class="text-muted">{{ $header->subtitle }}</h4>
                            @endif
                            <p class="lead mt-2">
                                {{ $header->description ?? 'Todas las noticias más relevantes de la ciudad de Iquitos' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Barra lateral izquierda - Novedades -->
        <div class="col-lg-3">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-soft-green border-0">
                    <h5 class="mb-0"><i class="bi bi-megaphone"></i> Novedades</h5>
                </div>
                <div class="card-body">
                    <!-- Últimas noticias -->
                    <div class="mb-4">
                        <h6 class="fw-bold text-primary"><i class="bi bi-newspaper"></i> Últimas noticias</h6>
                        <ul class="list-unstyled">
                            @foreach($latestNews as $news)
                                <li class="py-2 border-bottom">
                                    <a href="{{ route('news.show', $news) }}" class="text-decoration-none text-dark">
                                        {{ $news->title }}
                                    </a>
                                    <br>
                                    <small class="text-muted">{{ $news->published_at->diffForHumans() }}</small>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Más leídas (simuladas) -->
                    <div class="mb-4">
                        <h6 class="fw-bold text-danger"><i class="bi bi-fire"></i> Más leídas</h6>
                        <ol class="ps-3">
                            <li class="py-1">¿Habrá autoridad contra las inundaciones?</li>
                            <li class="py-1">Caos en el puerto de Iquitos</li>
                            <li class="py-1">Municipio bajo la lupa</li>
                        </ol>
                    </div>

                    <!-- Clima -->
                    <div class="weather-widget mb-4">
                        <h6 class="text-white"><i class="bi bi-cloud-sun"></i> Hoy en Iquitos</h6>
                        <p class="mb-1">🌡️ Temp: 32°C</p>
                        <p class="mb-1">💧 Humedad: Alta</p>
                        <p class="mb-0">🌧️ Lluvias: Probables</p>
                    </div>

                    <!-- Frase -->
                    <div class="bg-light p-3 rounded">
                        <h6 class="fw-bold"><i class="bi bi-quote"></i> Frase del día</h6>
                        <p class="fst-italic mb-0">"Loreto no necesita discursos, necesita gestión."</p>
                    </div>
                </div>
            </div>

            @foreach($sections as $section)
                <section class="card shadow-sm border-0 mt-4">
                    <div class="card-header bg-soft-green border-0 d-flex justify-content-between align-items-center gap-2">
                        <h5 class="mb-0"><i class="bi bi-collection"></i> {{ $section->title }}</h5>
                        <a href="{{ route('sections.show', $section) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-eye"></i> Ver sección
                        </a>
                    </div>
                    <div class="card-body">
                        @forelse($section->news as $news)
                            <div class="news-card p-3 mb-3" onclick="window.location='{{ route('news.show', $news) }}'">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        @if($news->image)
                                            <img src="{{ asset('storage/' . $news->image) }}" class="img-fluid rounded" alt="{{ $news->title }}" style="height: 110px; width: 100%; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 110px;"><i class="bi bi-newspaper text-muted" style="font-size: 2rem;"></i></div>
                                        @endif
                                    </div>
                                    <div class="col-md-8 home-news-content">
                                        <h6 class="fw-bold">{{ $news->title }}</h6>
                                        <p class="text-muted small mb-2">{{ Str::limit($news->summary, 110) }}</p>
                                        <span class="badge bg-warning text-dark">{{ $news->published_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted mb-0">Aún no hay noticias publicadas en esta sección.</p>
                        @endforelse
                    </div>
                </section>
            @endforeach
        </div>

        <!-- Sección principal - Noticias -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-soft-green border-0">
                    <h5 class="mb-0"><i class="bi bi-grid"></i> Noticias Destacadas</h5>
                </div>
                <div class="card-body">
                    @forelse($featuredNews as $news)
                        <div class="news-card p-3 mb-3" onclick="window.location='{{ route('news.show', $news) }}'">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    @if($news->image)
                                        <img src="{{ asset('storage/' . $news->image) }}" 
                                             class="img-fluid rounded" alt="{{ $news->title }}" style="height: 120px; width: 100%; object-fit: cover;">
                                    @else
                                        <img src="https://via.placeholder.com/300x200/235347/FFFFFF?text=Noticia" 
                                             class="img-fluid rounded" alt="Noticia" style="height: 120px; width: 100%; object-fit: cover;">
                                    @endif
                                </div>
                                <div class="col-md-8 home-news-content">
                                    <h5 class="fw-bold">{{ $news->title }}</h5>
                                    <p class="text-muted small">{{ Str::limit($news->summary, 100) }}</p>
                                    <div class="home-news-meta d-flex flex-wrap align-items-center gap-1">
                                        <span class="badge bg-warning text-dark">{{ $news->published_at->diffForHumans() }}</span>
                                        @if($news->category)
                                            <span class="badge bg-info text-dark">{{ $news->category }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="bi bi-newspaper" style="font-size: 3rem; color: #ccc;"></i>
                            <p class="mt-2 text-muted">No hay noticias destacadas aún</p>
                        </div>
                    @endforelse

                    <!-- Ver más noticias -->
                    <div class="text-center mt-3">
                        <a href="{{ route('news.public') }}" class="btn btn-gold">
                            <i class="bi bi-eye"></i> Ver todas las noticias
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Barra lateral derecha - Publicidad -->
        <div class="col-lg-3">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-soft-green border-0">
                    <h5 class="mb-0"><i class="bi bi-megaphone"></i> Publicidad</h5>
                </div>
                <div class="card-body">
                    @forelse($sidebarAds as $ad)
                        <div class="mb-3">
                            @if($ad->link)
                                <a href="{{ $ad->link }}" target="_blank">
                                    @if($ad->image)
                                        <img src="{{ asset('storage/' . $ad->image) }}" 
                                             class="img-fluid rounded w-100" alt="{{ $ad->title }}" style="height: 150px; object-fit: cover;">
                                    @else
                                        <img src="https://via.placeholder.com/200x150/e67e22/FFFFFF?text={{ urlencode($ad->title) }}" 
                                             class="img-fluid rounded w-100" alt="{{ $ad->title }}" style="height: 150px; object-fit: cover;">
                                    @endif
                                </a>
                            @else
                                @if($ad->image)
                                    <img src="{{ asset('storage/' . $ad->image) }}" 
                                         class="img-fluid rounded w-100" alt="{{ $ad->title }}" style="height: 150px; object-fit: cover;">
                                @else
                                    <img src="https://via.placeholder.com/200x150/e67e22/FFFFFF?text={{ urlencode($ad->title) }}" 
                                         class="img-fluid rounded w-100" alt="{{ $ad->title }}" style="height: 150px; object-fit: cover;">
                                @endif
                            @endif
                            <p class="mt-2 small text-center">{{ $ad->description ?? $ad->title }}</p>
                        </div>
                    @empty
                        <div class="bg-warning p-4 rounded text-center">
                            <h6 class="fw-bold">TU PUBLICIDAD AQUÍ</h6>
                            <small>Contacta al 999-999-999</small>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-4 py-3 bg-dark text-white rounded">
        <div class="container text-center">
            <small>© {{ date('Y') }} {{ $header->title ?? 'Semanario Loretano' }} | Iquitos – Loreto | Contacto: info@semanarioloretano.com</small>
        </div>
    </footer>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Efecto hover en tarjetas de noticias
        $('.news-card').hover(
            function() {
                $(this).css('transform', 'translateX(5px)');
            },
            function() {
                $(this).css('transform', 'translateX(0)');
            }
        );

        // Animación de entrada
        $('.news-card').each(function(index) {
            $(this).css('opacity', '0');
            setTimeout(() => {
                $(this).animate({ opacity: 1 }, 500);
            }, 200 * index);
        });
    });
</script>
@endsection