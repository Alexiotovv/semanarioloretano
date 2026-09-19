@extends('layouts.admin')

@section('title', 'Diseño')

@section('admin-content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-soft-green">
                    <h5 class="mb-0"><i class="bi bi-palette"></i> Diseño del Sitio</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @php $headerDesignHasError = $errors->hasAny(['header_font_family', 'header_title_font_size', 'header_text_color']); @endphp
                    <ul class="nav nav-tabs" id="designTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $headerDesignHasError ? '' : 'active' }}" id="login-tab" data-bs-toggle="tab" data-bs-target="#login-pane"
                                    type="button" role="tab" aria-controls="login-pane" aria-selected="{{ $headerDesignHasError ? 'false' : 'true' }}">
                                <i class="bi bi-box-arrow-in-right"></i> Diseño del Login
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $headerDesignHasError ? 'active' : '' }}" id="header-tab" data-bs-toggle="tab" data-bs-target="#header-pane"
                                    type="button" role="tab" aria-controls="header-pane" aria-selected="{{ $headerDesignHasError ? 'true' : 'false' }}">
                                <i class="bi bi-layout-text-window"></i> Diseño del Encabezado
                            </button>
                        </li>
                    </ul>

                    <form action="{{ route('design.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="tab-content border border-top-0 rounded-bottom p-3 mb-3" id="designTabContent">
                            <div class="tab-pane fade {{ $headerDesignHasError ? '' : 'show active' }}" id="login-pane" role="tabpanel" aria-labelledby="login-tab">
                                <div class="mb-3">
                                    <label for="login_title" class="form-label">Título del login</label>
                                    <input type="text" class="form-control @error('login_title') is-invalid @enderror"
                                           id="login_title" name="login_title" value="{{ old('login_title', $header->login_title ?? 'Semanario Loretano') }}">
                                    @error('login_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="login_subtitle" class="form-label">Texto debajo del título</label>
                                    <input type="text" class="form-control @error('login_subtitle') is-invalid @enderror"
                                           id="login_subtitle" name="login_subtitle" value="{{ old('login_subtitle', $header->login_subtitle ?? 'Accede al panel de administración') }}">
                                    @error('login_subtitle')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="login_logo" class="form-label">Logo del login</label>
                                    @if($header && $header->login_logo)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $header->login_logo) }}"
                                                 class="img-fluid rounded" style="max-height: 80px;" alt="Logo del login">
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('login_logo') is-invalid @enderror"
                                           id="login_logo" name="login_logo" accept="image/*">
                                    @error('login_logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Si no se sube un logo, se muestra un ícono por defecto. Formatos: JPEG, PNG, JPG, GIF. Máximo 2MB.</small>
                                </div>

                                <div class="mb-3">
                                    <label for="navbar_bg_color" class="form-label">Color del navbar</label>
                                    <input type="color" class="form-control form-control-color @error('navbar_bg_color') is-invalid @enderror"
                                           id="navbar_bg_color" name="navbar_bg_color" value="{{ old('navbar_bg_color', $header->navbar_bg_color ?? '#003d2b') }}">
                                    @error('navbar_bg_color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="footer_bg_color" class="form-label">Color del footer</label>
                                    <input type="color" class="form-control form-control-color @error('footer_bg_color') is-invalid @enderror"
                                           id="footer_bg_color" name="footer_bg_color" value="{{ old('footer_bg_color', $header->footer_bg_color ?? '#003d2b') }}">
                                    @error('footer_bg_color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="tab-pane fade {{ $headerDesignHasError ? 'show active' : '' }}" id="header-pane" role="tabpanel" aria-labelledby="header-tab">
                                <div class="mb-3">
                                    <label for="header_font_family" class="form-label">Tipo de letra del título</label>
                                    <select class="form-select @error('header_font_family') is-invalid @enderror"
                                            id="header_font_family" name="header_font_family">
                                        @php $currentFont = old('header_font_family', $header->header_font_family ?? 'Playfair Display'); @endphp
                                        @foreach(['Playfair Display', 'Open Sans', 'Roboto', 'Merriweather', 'Montserrat'] as $font)
                                            <option value="{{ $font }}" {{ $currentFont === $font ? 'selected' : '' }}>{{ $font }}</option>
                                        @endforeach
                                    </select>
                                    @error('header_font_family')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="header_title_font_size" class="form-label">Tamaño del título (px)</label>
                                    <input type="number" class="form-control @error('header_title_font_size') is-invalid @enderror"
                                           id="header_title_font_size" name="header_title_font_size" min="14" max="80"
                                           value="{{ old('header_title_font_size', $header->header_title_font_size ?? 34) }}">
                                    @error('header_title_font_size')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Tamaño del título en el encabezado (entre 14 y 80 px).</small>
                                </div>

                                <div class="mb-3">
                                    <label for="header_text_color" class="form-label">Color del texto del encabezado</label>
                                    <input type="color" class="form-control form-control-color @error('header_text_color') is-invalid @enderror"
                                           id="header_text_color" name="header_text_color" value="{{ old('header_text_color', $header->header_text_color ?? '#ffffff') }}">
                                    @error('header_text_color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Aplica al título, subtítulo y descripción del encabezado.</small>
                                </div>
                            </div>
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
