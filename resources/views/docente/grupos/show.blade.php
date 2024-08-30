@extends('adminlte::page')

@section('adminlte_css_pre')
    <link href="{{ asset('assets/css/simple-datatables.css') }}" rel="stylesheet" />
@endsection

@section('content_header')
    @include('adminlte::partials.common.header', [
        'icon' => 'fas fa-file-alt',
        'title' => 'Registros del Grupo: ' . $grupo->nombre,
    ])
@endsection

@section('content')
    <div class="card">
        <form action="{{ route('docente.reporte.asistencias', $grupo) }}" method="post">
            @csrf
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-download mr-1"></i>
                            Reporte
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <button type="submit" role="link" class="dropdown-item">PDF</button>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <input type="checkbox" class="form-check-input" id="hora" name="hora">
                        <label class="form-check-label" for="hora">Incluir horas</label>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row mb-0">
                    <label class="col-md-2 col-12" for="fecha_inicio">Desde</label>
                    <div class="col-md-4 col-12 mb-2 mb-md-0">
                        <input class="form-control @error('fecha_inicio') is-invalid @enderror" type="date"
                            name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio') }}" required>
                        @error('fecha_inicio')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <label class="col-md-2 col-12" for="fecha_fin">Hasta</label>
                    <div class="col-md-4 col-12">
                        <input class="form-control @error('fecha_fin') is-invalid @enderror" type="date" name="fecha_fin"
                            id="fecha_fin" value="{{ old('fecha_fin') }}" required>
                        @error('fecha_fin')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-6 text-left"><a href="{{ route('docente.grupos.index') }}"
                        class="btn btn-secondary">Regresar</a></div>
                <div class="col-6 text-right"><a href="{{ route('docente.registros.create', $grupo) }}"
                        class="btn btn-primary">Nuevo Registro</a></div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($registros as $registro)
                        <tr>
                            <td>{{ $registro->fecha }}</td>
                            <td>{{ $registro->hora }}</td>
                            {{-- <td>{{ $registro->informe ? 'Sí' : 'No' }}</td> --}}
                            <td>
                                <a href="{{ route('docente.registros.edit', $registro) }}" class="btn btn-warning mr-1"><i
                                        class="fas fa-pencil-alt"></i></a>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#{{ 'm' . $registro->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <div class="modal fade" id="{{ 'm' . $registro->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Eliminar Registro</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Al eliminar este registro, todos los datos de asistencias asociados serán
                                                borrados permanentemente y no podrán ser recuperados. ¿Estás seguro de que
                                                deseas continuar?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancelar</button>
                                                <form action="{{ route('docente.registros.destroy', $registro) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Sí, Eliminar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                new simpleDatatables.DataTable(datatablesSimple, {
                    columns: [{
                        select: 2,
                        searchable: false,
                        sortable: false
                    }, ]
                });
            }
        });
    </script>
@endsection
