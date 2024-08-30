@extends('adminlte::page')

@section('content_header')
    @include('adminlte::partials.common.header', [
        'icon' => 'fas fa-graduation-cap',
        'title' => 'Mis Grupos',
    ])
@endsection

@section('content')

    @if ($grupos->isEmpty())
        <div class="d-flex justify-content-center align-items-center py-5 my-5 text-center">
            <div>
                <i class="fas fa-exclamation-circle fa-4x mb-3 text-secondary"></i>
                <h3 class="text-secondary">No tienes grupos asignados actualmente.</h3>
            </div>
        </div>
    @else
        <div class="row">
            @foreach ($grupos as $grupo)
                <div class="col-lg-4 col-sm-6 mb-1">
                    <div class="card text-dark">
                        <div class="card-header">
                            <h5 class="card-title">{{ $grupo->nombre }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="my-0"><b>Curso:</b> {{ $grupo->curso->nombre }}</p>
                            <p class="my-0"><b>Grado:</b> {{ $grupo->grado->nombre }}</p>
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('docente.grupos.show', $grupo) }}" class="btn btn-primary">
                                Ver Registros
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection
