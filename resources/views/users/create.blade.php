@extends('layouts.admin')

@section('title', 'Nuevo Usuario')

@section('admin-content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-header bg-soft-green">
                    <h5 class="mb-0"><i class="bi bi-person-plus"></i> Nuevo usuario</h5>
                </div>
                <div class="card-body">
                    @include('users._form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
