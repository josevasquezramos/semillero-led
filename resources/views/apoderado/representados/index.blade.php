@extends('adminlte::page')

@section('content_header')
    @include('adminlte::partials.common.header', [
        'icon' => 'fas fa-user-graduate',
        'title' => 'Alumnos bajo mi tutela',
    ])
@endsection

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($alumnos->isEmpty())
        <div class="d-flex justify-content-center align-items-center py-5 my-5 text-center">
            <div>
                <i class="fas fa-exclamation-circle fa-4x mb-3 text-secondary"></i>
                <h5 class="text-secondary px-5">No tienes ningún alumno bajo tu tutela en estos momentos, puedes agregar uno
                    <a href="{{ route('apoderado.alumnos.searchForm') }}">aquí</a>.
                </h5>
            </div>
        </div>
    @else
        <div class="row">
            @foreach ($alumnos as $apoderado)
                <div class="col-lg-4 col-md-6 mb-1">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h5 class="card-title mb-0 flex-grow-1">Alumno</h5>
                            <button type="button" class="btn btn-sm btn-danger ml-3" data-toggle="modal"
                                data-target="#m{{ $apoderado->id }}">
                                <i class="fas fa-times px-1"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-striped">
                                <tr>
                                    <th>Alumno:</th>
                                    <td>{{ $apoderado->alumno->nombres }} {{ $apoderado->alumno->apellido_paterno }}
                                        {{ $apoderado->alumno->apellido_materno }}</td>
                                </tr>
                                <tr>
                                    <th>DNI:</th>
                                    <td>{{ $apoderado->alumno->dni }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-dark" data-toggle="modal"
                                    data-target="#q{{ $apoderado->id }}">
                                    <i class="fas fa-qrcode mr-1"></i>
                                    Ver QR
                                </button>
                                <a href="{{ route('apoderado.representados.grupos.index', $apoderado->alumno->id) }}"
                                    class="btn btn-primary float-right">Ver Clases</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="m{{ $apoderado->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="em{{ $apoderado->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="em{{ $apoderado->id }}">Advertencia</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Si desvinculas al alumno, dejarás de recibir notificaciones sobre su asistencia a clase.
                                ¿Estás seguro de que deseas hacer esto?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Cerrar
                                </button>
                                <form action="{{ route('apoderado.representados.destroy', $apoderado->alumno->id) }}"
                                    method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Desvincular</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="q{{ $apoderado->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="eq{{ $apoderado->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="eq{{ $apoderado->id }}">Código QR</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center">
                                    {!! QrCode::size(250)->generate($apoderado->alumno->id) !!}
                                </p>
                                <p class="mb-0">
                                    Este código QR es exclusivo para el alumno {{ $apoderado->alumno->nombres }}. Puedes
                                    descargarlo e imprimirlo para que el profesor pueda registrar la asistencia de manera
                                    automática y eficiente.
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <form action="{{ route('apoderado.representados.downloadQR', $apoderado->alumno->id) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-download mr-1"></i>
                                        Descargar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
