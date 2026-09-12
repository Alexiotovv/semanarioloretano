@extends('layouts.app')

@section('title', 'Contáctenos - ' . ($header->title ?? 'Semanario Loretano'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h1 class="h3 mb-4">
                        <i class="bi bi-envelope-paper"></i> Contáctenos
                    </h1>
                    <p class="text-muted">
                        Puede comunicarse con nosotros a través de los siguientes medios:
                    </p>
                    <ul class="list-unstyled fs-5">
                        <li class="mb-3">
                            <i class="bi bi-telephone-fill text-success"></i>
                            {{ $header->contact_phone ?? 'Teléfono no disponible' }}
                        </li>
                        <li>
                            <i class="bi bi-envelope-fill text-success"></i>
                            {{ $header->contact_email ?? 'Correo no disponible' }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
