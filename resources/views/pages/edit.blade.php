@extends('layouts.admin')

@section('title', 'Contáctenos / Acerca de nosotros')

@section('admin-content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-soft-green">
                    <h5 class="mb-0"><i class="bi bi-file-earmark-text"></i> Editar Contáctenos y Acerca de nosotros</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @php $aboutHasError = $errors->has('about_text'); @endphp
                    <ul class="nav nav-tabs" id="pagesTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $aboutHasError ? '' : 'active' }}" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-pane"
                                    type="button" role="tab" aria-controls="contact-pane" aria-selected="{{ $aboutHasError ? 'false' : 'true' }}">
                                <i class="bi bi-envelope"></i> Contáctenos
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $aboutHasError ? 'active' : '' }}" id="about-tab" data-bs-toggle="tab" data-bs-target="#about-pane"
                                    type="button" role="tab" aria-controls="about-pane" aria-selected="{{ $aboutHasError ? 'true' : 'false' }}">
                                <i class="bi bi-info-circle"></i> Acerca de nosotros
                            </button>
                        </li>
                    </ul>

                    <form action="{{ route('pages.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="tab-content border border-top-0 rounded-bottom p-3 mb-3" id="pagesTabContent">
                            <div class="tab-pane fade {{ $aboutHasError ? '' : 'show active' }}" id="contact-pane" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="mb-3">
                                    <label for="contact_phone" class="form-label">Teléfono de contacto</label>
                                    <input type="text" class="form-control @error('contact_phone') is-invalid @enderror"
                                           id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $header->contact_phone ?? '') }}">
                                    @error('contact_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="contact_email" class="form-label">Correo de contacto</label>
                                    <input type="email" class="form-control @error('contact_email') is-invalid @enderror"
                                           id="contact_email" name="contact_email" value="{{ old('contact_email', $header->contact_email ?? '') }}">
                                    @error('contact_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Estos datos se muestran en la página "Contáctenos".</small>
                                </div>
                            </div>

                            <div class="tab-pane fade {{ $aboutHasError ? 'show active' : '' }}" id="about-pane" role="tabpanel" aria-labelledby="about-tab">
                                <div class="mb-3">
                                    <label for="about_text" class="form-label">Contenido de "Acerca de nosotros"</label>
                                    <textarea class="form-control @error('about_text') is-invalid @enderror"
                                              id="about_text" name="about_text" rows="8">{{ old('about_text', $header->about_text ?? '') }}</textarea>
                                    @error('about_text')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Contenido mostrado en la página "Acerca de nosotros".</small>
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
