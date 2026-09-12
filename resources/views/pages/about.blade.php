@extends('layouts.app')

@section('title', 'Acerca de nosotros - ' . ($header->title ?? 'Semanario Loretano'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h1 class="h3 mb-4">
                        <i class="bi bi-info-circle"></i> Acerca de nosotros
                    </h1>
                    <div class="fs-5" style="white-space: pre-line;">
                        {{ $header->about_text ?? 'Información no disponible por el momento.' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
