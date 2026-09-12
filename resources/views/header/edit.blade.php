@extends('layouts.admin')

@section('title', 'Editar Encabezado')

@section('admin-content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-soft-green">
                    <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Editar Encabezado del Semanario</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('header.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $header->title ?? '') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="subtitle" class="form-label">Subtítulo</label>
                            <input type="text" class="form-control @error('subtitle') is-invalid @enderror" 
                                   id="subtitle" name="subtitle" value="{{ old('subtitle', $header->subtitle ?? '') }}">
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" required>{{ old('description', $header->description ?? '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Imagen del encabezado principal (1 de 3)</label>
                            @if($header && $header->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $header->image) }}" 
                                         class="img-fluid rounded" style="max-height: 100px;" alt="Header Image">
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
                            <label for="image_2" class="form-label">Imagen del encabezado (2 de 3)</label>
                            @if($header && $header->image_2)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $header->image_2) }}" 
                                         class="img-fluid rounded" style="max-height: 100px;" alt="Header Image 2">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('image_2') is-invalid @enderror" 
                                   id="image_2" name="image_2" accept="image/*">
                            @error('image_2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Formatos permitidos: JPEG, PNG, JPG, GIF. Máximo 2MB.</small>
                        </div>

                        <div class="mb-3">
                            <label for="image_3" class="form-label">Imagen del encabezado (3 de 3)</label>
                            @if($header && $header->image_3)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $header->image_3) }}" 
                                         class="img-fluid rounded" style="max-height: 100px;" alt="Header Image 3">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('image_3') is-invalid @enderror" 
                                   id="image_3" name="image_3" accept="image/*">
                            @error('image_3')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Las 3 imágenes rotan automáticamente en el encabezado. Formatos: JPEG, PNG, JPG, GIF. Máximo 2MB.</small>
                        </div>

                        <div class="mb-3">
                            <label for="navbar_logo" class="form-label">Logo del navbar</label>
                            @if($header && $header->navbar_logo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $header->navbar_logo) }}"
                                         class="img-fluid rounded" style="max-height: 60px;" alt="Logo actual del navbar">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('navbar_logo') is-invalid @enderror"
                                   id="navbar_logo" name="navbar_logo" accept="image/*">
                            @error('navbar_logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Imagen independiente para el navbar. Formatos: JPEG, PNG, JPG, GIF. Máximo 2MB.</small>
                        </div>

                        <div class="mb-3">
                            <label for="navbar_logo_height" class="form-label">Tamaño del logo (alto en píxeles)</label>
                            <input type="number" class="form-control @error('navbar_logo_height') is-invalid @enderror"
                                   id="navbar_logo_height" name="navbar_logo_height" min="20" max="300"
                                   value="{{ old('navbar_logo_height', $header->navbar_logo_height ?? 70) }}">
                            @error('navbar_logo_height')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Define la altura del logo en el encabezado (entre 20 y 300 px).</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Volver al Dashboard
                            </a>
                            <button type="submit" class="btn btn-gold">
                                <i class="bi bi-save"></i> Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection