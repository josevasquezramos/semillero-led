@extends('adminlte::page')

@section('content_header')
    @include('adminlte::partials.common.header', [
        'icon' => 'fas fa-chalkboard-teacher',
        'title' => 'Cursos de ' . $alumno->nombres . ' ' . $alumno->apellido_paterno,
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Cursos</h5>
                <a href="{{ route('apoderado.representados.index') }}" class="btn btn-secondary">Regresar</a>
            </div>
        </div>
    </div>
    @if ($grupos->isEmpty())
        <div class="d-flex justify-content-center align-items-center py-5 my-5 text-center">
            <div>
                <i class="fas fa-exclamation-circle fa-4x mb-3 text-secondary"></i>
                <h5 class="text-secondary px-5">El alumno
                    <b>{{ $alumno->apellido_paterno . ' ' . $alumno->apellido_materno . ' ' . $alumno->nombres }}</b> no
                    está matriculado a ningún curso en estos momentos. Si crees que se trata de un error, no dudes en
                    comunicarte con nosotros.
                </h5>
            </div>
        </div>
    @else
        <div class="row">
            @foreach ($grupos as $grupo)
                <div class="col-lg-4 col-md-6 mb-1">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{ $grupo->curso->nombre }}</h5>
                        </div>

                        <div class="card-body">
                            <table class="table table-sm table-striped">
                                {{--<tr>
                                    <th>Curso:</th>
                                    <td>{{ $grupo->curso->nombre }}</td>
                                </tr>--}}
                                <tr>
                                    <th>Grupo:</th>
                                    <td>{{ $grupo->nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Periodo:</th>
                                    <td>{{ $grupo->periodo->nombre }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('apoderado.representados.grupos.asistencias.index', [$alumno->id, $grupo->id]) }}"
                                class="btn btn-primary">Ver Asistencias</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
