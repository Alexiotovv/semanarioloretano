<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Semanario Loretano')</title>
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-green: #235347;
            --secondary-green: #728156;
            --accent-gold: #c9a96e;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            background: #f5f0eb;
        }
        
        .navbar-custom {
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            box-shadow: 0 2px 15px rgba(0,0,0,0.2);
            padding: 10px 0;
        }
        
        .navbar-custom .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: white !important;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .navbar-brand img {
            height: 50px;
            width: auto;
            border-radius: 10px;
            object-fit: cover;
        }
        
        .navbar-brand .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }
        
        .navbar-brand .brand-title {
            font-size: 1.8rem;
            font-weight: 700;
        }
        
        .navbar-brand .brand-subtitle {
            font-size: 0.75rem;
            font-weight: 400;
            opacity: 0.8;
            font-family: 'Open Sans', sans-serif;
        }
        
        .navbar-custom .nav-link {
            color: rgba(255,255,255,0.9) !important;
            transition: all 0.3s;
        }
        
        .navbar-custom .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }
        
        .btn-gold {
            background: var(--accent-gold);
            color: white;
            border: none;
            transition: all 0.3s;
        }
        
        .btn-gold:hover {
            background: #b8944a;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(201, 169, 110, 0.4);
        }
        
        .news-card {
            border-left: 4px solid var(--accent-gold);
            background: white;
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .news-card:hover {
            border-left-color: var(--primary-green);
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transform: translateX(5px);
        }
        
        .weather-widget {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            border-radius: 15px;
            padding: 20px;
        }
        
        .bg-soft-green {
            background: linear-gradient(135deg, #f0f4ec, #e8ede4);
        }
        
        .sidebar-link {
            color: #333;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s;
            margin-bottom: 5px;
        }
        
        .sidebar-link:hover {
            background: var(--primary-green);
            color: white;
            transform: translateX(5px);
        }
        
        .sidebar-link.active {
            background: var(--primary-green);
            color: white;
        }
        
        .sidebar-link i {
            font-size: 1.2rem;
            width: 24px;
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

        .navbar-toggler {
            border-color: rgba(255,255,255,0.5);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.9)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .navbar-news-ticker {
            min-width: 0;
            max-width: 340px;
            color: rgba(255,255,255,0.9);
        }

        .navbar-news-date {
            font-size: 0.75rem;
            white-space: nowrap;
        }

        .navbar-news-window {
            max-width: 100%;
            overflow: hidden;
            white-space: nowrap;
        }

        .navbar-news-track {
            display: inline-flex;
            gap: 2rem;
            min-width: max-content;
            animation: navbar-news-scroll 24s linear infinite;
        }

        .navbar-news-item {
            display: inline-block;
            font-size: 0.75rem;
        }

        @keyframes navbar-news-scroll {
            from { transform: translateX(100%); }
            to { transform: translateX(-100%); }
        }

        @media (prefers-reduced-motion: reduce) {
            .navbar-news-track {
                animation: none;
            }
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                @php
                    $header = App\Models\Header::first();
                    $latestNavbarNews = App\Models\News::whereNotNull('published_at')
                        ->orderBy('published_at', 'desc')
                        ->take(5)
                        ->get();
                    $navbarSections = App\Models\Section::where('show_in_nav', true)
                        ->orderBy('title')
                        ->get();
                @endphp
                @if($header && $header->navbar_logo)
                    <img src="{{ asset('storage/' . $header->navbar_logo) }}" alt="{{ $header->title }}" class="d-inline-block align-text-top">
                @else
                    <i class="bi bi-newspaper" style="font-size: 2.5rem; color: white;"></i>
                @endif
                <div class="brand-text">
                    <span class="brand-title">{{ $header->title ?? 'Semanario Loretano' }}</span>
                    @if($header && $header->subtitle)
                        <span class="brand-subtitle">{{ $header->subtitle }}</span>
                    @endif
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('news.public') }}">
                            <i class="bi bi-eye"></i> Noticias
                        </a>
                    </li>
                    @foreach($navbarSections as $navbarSection)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('sections.show', $navbarSection) }}">
                                {{ $navbarSection->title }}
                            </a>
                        </li>
                    @endforeach
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i> Salir
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li class="nav-item navbar-news-ticker">
                            <div class="navbar-news-date text-end">
                                📅
                                {{ now()->translatedFormat('l, d \d\e F \d\e Y') }}
                            </div>
                            @if($latestNavbarNews->isNotEmpty())
                                <div class="navbar-news-window" aria-label="Últimas noticias">
                                    <div class="navbar-news-track">
                                        @foreach($latestNavbarNews as $latestNews)
                                            <span class="navbar-news-item">
                                                📰 {{ $latestNews->title }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main>
        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')
</body>
</html>