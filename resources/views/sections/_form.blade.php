@php($isEdit = isset($section))
<form action="{{ $isEdit ? route('sections.update', $section) : route('sections.store') }}" method="POST">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="title" class="form-label">Nombre de la sección</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $section->title ?? '') }}" required>
        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-4 form-check">
        <input type="checkbox" class="form-check-input" id="show_in_nav" name="show_in_nav" value="1" {{ old('show_in_nav', $section->show_in_nav ?? false) ? 'checked' : '' }}>
        <label class="form-check-label" for="show_in_nav">Mostrar en el menú de navegación</label>
    </div>
    <div class="d-flex justify-content-between">
        <a href="{{ route('sections.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
        <button type="submit" class="btn btn-gold"><i class="bi bi-save"></i> {{ $isEdit ? 'Actualizar sección' : 'Crear sección' }}</button>
    </div>
</form>
