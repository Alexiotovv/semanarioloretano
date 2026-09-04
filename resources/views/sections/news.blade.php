@extends('layouts.admin')

@section('title', 'Noticias de ' . $section->title)

@section('admin-content')
<div class="container-fluid py-1">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h4 class="mb-1"><i class="bi bi-newspaper"></i> {{ $section->title }}</h4>
            <p class="text-muted mb-0">Noticias de esta sección</p>
        </div>
        <a href="{{ route('news.create', ['section_id' => $section->id]) }}" class="btn btn-gold">
            <i class="bi bi-plus-circle"></i> Nueva noticia
        </a>
    </div>
    <div class="card shadow-sm"><div class="card-body"><div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead><tr><th>Título</th><th>Categoría</th><th>Publicada</th><th class="text-end">Acciones</th></tr></thead>
            <tbody>
                @forelse($news as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->category ?? '-' }}</td>
                        <td>{{ $item->published_at?->format('d/m/Y') ?? '-' }}</td>
                        <td class="text-end"><a href="{{ route('news.edit', $item) }}" class="btn btn-sm btn-outline-warning" title="Editar noticia"><i class="bi bi-pencil"></i></a></td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-muted py-4">Esta sección aún no tiene noticias.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>{{ $news->links() }}</div></div>
    <a href="{{ route('sections.index') }}" class="btn btn-secondary mt-3"><i class="bi bi-arrow-left"></i> Volver a secciones</a>
</div>
@endsection