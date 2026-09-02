@extends('layouts.app')

@section('title', 'Editar Noticia')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-soft-green">
                    <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Editar Noticia</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('news.update', $news) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $news->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Categoría</label>
                            <input type="text" class="form-control @error('category') is-invalid @enderror" 
                                   id="category" name="category" value="{{ old('category', $news->category) }}">
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="summary" class="form-label">Resumen</label>
                            <textarea class="form-control @error('summary') is-invalid @enderror" 
                                      id="summary" name="summary" rows="3" required>{{ old('summary', $news->summary) }}</textarea>
                            @error('summary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Contenido</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                      id="content" name="content" rows="6" required>{{ old('content', $news->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Imagen</label>
                            @if($news->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $news->image) }}" 
                                         class="img-fluid rounded" style="max-height: 150px;" alt="Imagen actual">
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

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1"
                                   {{ old('is_featured', $news->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">Marcar como destacada</label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('news.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Volver
                            </a>
                            <button type="submit" class="btn btn-gold">
                                <i class="bi bi-save"></i> Actualizar Noticia
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection