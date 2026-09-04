@extends('layouts.admin')

@section('title', 'Gestionar Secciones')

@section('admin-content')
<div class="container-fluid py-1">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4><i class="bi bi-collection"></i> Gestionar Secciones</h4>
        <a href="{{ route('sections.create') }}" class="btn btn-gold"><i class="bi bi-plus-circle"></i> Nueva sección</a>
    </div>
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    <div class="card shadow-sm"><div class="card-body"><div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead><tr><th>Sección</th><th>Navbar público</th><th>Noticias</th><th class="text-end">Acciones</th></tr></thead>
            <tbody>
                @forelse($sections as $section)
                    <tr>
                        <td>{{ $section->title }}</td>
                        <td>{!! $section->show_in_nav ? '<span class="badge bg-success">Visible</span>' : '<span class="badge bg-secondary">Oculta</span>' !!}</td>
                        <td>{{ $section->news()->count() }}</td>
                        <td class="text-end"><div class="btn-group btn-group-sm">
                            <a href="{{ route('sections.news.index', $section) }}" class="btn btn-outline-primary" title="Gestionar noticias"><i class="bi bi-newspaper"></i></a>
                            <a href="{{ route('sections.edit', $section) }}" class="btn btn-outline-warning" title="Editar sección"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('sections.destroy', $section) }}" method="POST">@csrf @method('DELETE')<button class="btn btn-outline-danger" title="Eliminar sección" onclick="return confirm('¿Eliminar esta sección?')"><i class="bi bi-trash"></i></button></form>
                        </div></td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-muted py-4">No hay secciones creadas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>{{ $sections->links() }}</div></div>
</div>
@endsection
