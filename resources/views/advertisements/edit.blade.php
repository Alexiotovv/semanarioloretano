@extends('layouts.admin')

@section('title', 'Editar Publicidad')

@section('admin-content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-soft-green">
                    <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Editar Publicidad</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('advertisements.update', $advertisement) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $advertisement->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="2">{{ old('description', $advertisement->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="link" class="form-label">Enlace (URL)</label>
                            <input type="url" class="form-control @error('link') is-invalid @enderror" 
                                   id="link" name="link" value="{{ old('link', $advertisement->link) }}" placeholder="https://ejemplo.com">
                            @error('link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Dejar vacío si no tiene enlace</small>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Imagen</label>
                            @if($advertisement->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $advertisement->image) }}" 
                                         class="img-fluid rounded" style="max-height: 100px;" alt="Imagen actual">
                                    <br>
                                    <small class="text-muted">Imagen actual</small>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Formatos permitidos: JPEG, PNG, JPG, GIF. Máximo 2MB.</small>
                        </div>

                        <div class="mb-3">
                            <label for="position" class="form-label">Posición</label>
                            <select class="form-control @error('position') is-invalid @enderror" 
                                    id="position" name="position" required>
                                <option value="sidebar" {{ old('position', $advertisement->position) == 'sidebar' ? 'selected' : '' }}>Sidebar (Barra lateral)</option>
                                <option value="banner" {{ old('position', $advertisement->position) == 'banner' ? 'selected' : '' }}>Banner (Destacado)</option>
                                <option value="footer" {{ old('position', $advertisement->position) == 'footer' ? 'selected' : '' }}>Footer (Pie de página)</option>
                            </select>
                            @error('position')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="order" class="form-label">Orden de aparición</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                   id="order" name="order" value="{{ old('order', $advertisement->order) }}" min="0">
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Número menor = aparece primero</small>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                                   {{ old('is_active', $advertisement->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Activo</label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('advertisements.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Volver
                            </a>
                            <button type="submit" class="btn btn-gold">
                                <i class="bi bi-save"></i> Actualizar Publicidad
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection