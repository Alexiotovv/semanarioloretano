@extends('layouts.admin')

@section('title', 'Gestionar Noticias')

@section('admin-content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4><i class="bi bi-newspaper"></i> Gestionar Noticias</h4>
        <a href="{{ route('news.create') }}" class="btn btn-gold">
            <i class="bi bi-plus-circle"></i> Nueva Noticia
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Título</th>
                            <th>Categoría</th>
                            <th>Destacada</th>
                            <th>Publicada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($news as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->category ?? 'Sin categoría' }}</td>
                                <td>
                                    @if($item->is_featured)
                                        <span class="badge bg-warning text-dark">⭐ Destacada</span>
                                    @else
                                        <span class="badge bg-secondary">Normal</span>
                                    @endif
                                </td>
                                <td>{{ $item->published_at ? $item->published_at->format('d/m/Y') : '-' }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('news.show', $item) }}" class="btn btn-outline-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('news.edit', $item) }}" class="btn btn-outline-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('news.destroy', $item) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" 
                                                    onclick="return confirm('¿Eliminar esta noticia?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $news->links() }}
            </div>
        </div>
    </div>
</div>
@endsection