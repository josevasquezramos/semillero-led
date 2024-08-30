@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/input-table.css') }}">
@endsection

@section('content_header')
    @include('adminlte::partials.common.header', [
        'icon' => 'fas fa-file',
        'title' => 'Editar Registro: ' . $grupo->nombre,
    ])
@endsection

@section('content')
    <form action="{{ route('docente.registros.update', $registro) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <i class="fas fa-pencil-alt mr-2"></i>
                        Editar Registro
                    </div>
                    <div class="col-6 text-right">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="form-group row">
                    <div class="col-6">
                        <label for="fecha">Fecha:</label>
                        <input type="date" name="fecha" id="fecha" class="form-control"
                            value="{{ $registro->fecha }}" required>
                    </div>
                    <div class="col-6">
                        <label for="hora">Hora:</label>
                        <input type="time" name="hora" id="hora" class="form-control"
                            value="{{ $registro->hora }}" required>
                    </div>
                </div>

                {{-- <div class="form-group">
                    <label for="informe">Informe:</label>
                    <input type="checkbox" name="informe" id="informe" {{ $registro->informe ? 'checked' : '' }}>
                </div> --}}

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Alumno</th>
                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="Presente">P</th>
                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="Falta">F</th>
                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="Tarde">T</th>
                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="Falta Justificada">J
                            </th>
                        </tr>
                    </thead>
                    <tbody id="studentTable">
                        @foreach ($asistencias as $asistencia)
                            @php
                                $alumno = $asistencia->grupoAlumno->alumno;
                                $alumnoId = $alumno->id;
                                $asistenciaId = $asistencia->id;
                                $asistio = $asistencia->asistio;
                            @endphp
                            <tr data-id="{{ $alumnoId }}">
                                <td>
                                    {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }} {{ $alumno->nombres }}
                                </td>
                                @foreach (['p' => 'Presente', 'f' => 'Falta', 't' => 'Tarde', 'j' => 'Justificado'] as $value => $label)
                                    <td class="input-cell">
                                        <label for="{{ $value }}_{{ $alumnoId }}" class="input-label"></label>
                                        <input id="{{ $value }}_{{ $alumnoId }}" type="radio"
                                            name="asistencias[{{ $asistenciaId }}]" value="{{ $value }}"
                                            {{ $asistio == $value ? 'checked' : '' }} required>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-right">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                    Cancelar
                </button>
            </div>
        </div>
    </form>

    <!-- Modal Advertencia -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Advertencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Todo cambio hecho hasta ahora no se actualizará.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="{{ route('docente.grupos.show', $grupo) }}" class="btn btn-danger">Aceptar y Retroceder</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
