@extends('adminlte::page')

@section('adminlte_css_pre')
    <link href="{{ asset('assets/css/simple-datatables.css') }}" rel="stylesheet" />
@endsection

@section('content_header')
    @include('adminlte::partials.common.header', [
        'icon' => 'fas fa-user-graduate',
        'title' => 'Registros del Alumno(a): '
            . $alumno->nombres . ' '
            . $alumno->apellido_paterno . ' '
            . $alumno->apellido_materno ,
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="card-title">
                    {{ $curso->nombre }}
                </h1>
                <a href="{{ route('apoderado.representados.grupos.index', $alumno->id) }}" class="btn btn-secondary">
                    Retroceder
                </a>
            </div>
        </div>
        <div class="card-body">
            <p class="mb-0"><b>Grado: </b> {{ $grado->nombre }}</p>
            <p class="mb-0"><b>Periodo: </b> {{ $periodo->nombre }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">

            <table class="table table-bordered table-striped" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asistencias as $asistencia)
                        <tr>
                            <td>{{ $asistencia->registro->fecha }}</td>
                            <td>{{ $asistencia->registro->hora }}</td>
                            <td>
                                @if ($asistencia->asistio === 'p')
                                    <span class="badge badge-success">Presente</span>
                                @elseif ($asistencia->asistio === 'f')
                                    <span class="badge badge-danger">Falta</span>
                                @elseif ($asistencia->asistio === 't')
                                    <span class="badge badge-warning">Tarde</span>
                                @elseif ($asistencia->asistio === 'j')
                                    <span class="badge badge-info">Justificada</span>
                                @else
                                    <span class="badge badge-secondary">No definido</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/js/simple-datatables.js') }}" crossorigin="anonymous"></script>
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            const datatablesSimple = document.getElementById('datatablesSimple');
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }
        });
    </script>
@endsection
