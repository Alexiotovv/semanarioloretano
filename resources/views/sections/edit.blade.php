@extends('layouts.admin')

@section('title', 'Editar Sección')

@section('admin-content')
<div class="container py-1"><div class="row justify-content-center"><div class="col-md-8"><div class="card shadow-sm">
    <div class="card-header bg-soft-green"><h5 class="mb-0"><i class="bi bi-pencil-square"></i> Editar sección</h5></div>
    <div class="card-body">@include('sections._form', ['section' => $section])</div>
</div></div></div></div>
@endsection
