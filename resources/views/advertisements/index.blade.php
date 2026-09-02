@extends('layouts.app')

@section('title', 'Gestionar Publicidad')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4><i class="bi bi-image"></i> Gestionar Publicidad</h4>
        <a href="{{ route('advertisements.create') }}" class="btn btn-gold">
            <i class="bi bi-plus-circle"></i> Nueva Publicidad
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
                            <th>Imagen</th>
                            <th>Título</th>
                            <th>Posición</th>
                            <th>Orden</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($advertisements as $ad)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($ad->image)
                                        <img src="{{ asset('storage/' . $ad->image) }}" 
                                             class="img-fluid rounded" style="width: 50px; height: 50px; object-fit: cover;" 
                                             alt="{{ $ad->title }}">
                                    @else
                                        <span class="text-muted">Sin imagen</span>
                                    @endif
                                </td>
                                <td>{{ $ad->title }}</td>
                                <td>
                                    <span class="badge bg-{{ $ad->position == 'sidebar' ? 'primary' : ($ad->position == 'banner' ? 'success' : 'secondary') }}">
                                        {{ ucfirst($ad->position) }}
                                    </span>
                                </td>
                                <td>{{ $ad->order }}</td>
                                <td>
                                    @if($ad->is_active)
                                        <span class="badge bg-success">Activo</span>
                                    @else
                                        <span class="badge bg-danger">Inactivo</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('advertisements.edit', $ad) }}" class="btn btn-outline-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('advertisements.destroy', $ad) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" 
                                                    onclick="return confirm('¿Eliminar esta publicidad?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    <div class="py-3">
                                        <i class="bi bi-images" style="font-size: 2rem;"></i>
                                        <p class="mb-0">No hay publicidades registradas</p>
                                        <a href="{{ route('advertisements.create') }}" class="btn btn-gold btn-sm mt-2">
                                            <i class="bi bi-plus-circle"></i> Crear primera publicidad
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $advertisements->links() }}
            </div>
        </div>
    </div>
</div>
@endsection