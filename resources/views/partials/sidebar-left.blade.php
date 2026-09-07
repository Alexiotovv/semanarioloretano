@php
    $analysisSection = $sections->first(fn ($section) => str_contains(mb_strtolower($section->title), 'anali'));
    $techSection = $sections->first(fn ($section) => str_contains(mb_strtolower($section->title), 'tecno'));
@endphp

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
