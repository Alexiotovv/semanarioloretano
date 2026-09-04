@extends('layouts.app')

@section('title', $section->title)

@section('content')
<div class="container py-4">
    <div class="row justify-content-center"><div class="col-lg-8">
        <a href="{{ route('home') }}" class="btn btn-outline-secondary mb-3"><i class="bi bi-arrow-left"></i> Volver al inicio</a>
        <section class="mt-4">
            <h1 class="h3 mb-3">{{ $section->title }}</h1>
            @forelse($section->news()->whereNotNull('published_at')->latest('published_at')->take(3)->get() as $news)
                <a href="{{ route('news.show', $news) }}" class="news-card d-block p-3 mb-3 text-decoration-none text-dark">
                    <div class="d-flex gap-3">
                        @if($news->image)
                            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}"
                                 class="rounded flex-shrink-0" style="width: 96px; height: 72px; object-fit: cover; object-position: top center;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center flex-shrink-0"
                                 style="width: 96px; height: 72px;">
                                <i class="bi bi-newspaper text-muted"></i>
                            </div>
                        @endif
                        <div>
                            <h3 class="h5 mb-1">{{ $news->title }}</h3>
                            <p class="mb-0 text-muted">{{ Str::limit($news->summary, 140) }}</p>
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-muted">Aún no hay noticias en esta sección.</p>
            @endforelse
        </section>
    </div></div>
</div>
@endsection
