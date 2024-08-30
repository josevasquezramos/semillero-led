@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/qr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/input-table.css') }}">
@endsection

@section('content_header')
    @include('adminlte::partials.common.header', [
        'icon' => 'fas fa-file',
        'title' => 'Nuevo Registro: ' . $grupo->nombre,
    ])
@endsection

@section('content')
    <form action="{{ route('docente.registros.store', $grupo) }}" method="POST">
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-6 text-left">
                        <button type="button" class="btn btn-primary" id="scanButton" data-toggle="modal"
                            data-target="#scanModal">
                            <i class="fas fa-qrcode mr-1"></i>
                            Escanear QR
                        </button>
                    </div>
                    <div class="col-6 text-right">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </div>
            <div class="card-body">

                @csrf

                <div class="form-group row">
                    <div class="col-6">
                        <label for="fecha">Fecha:</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label for="hora">Hora:</label>
                        <input type="time" name="hora" id="hora" class="form-control" required>
                    </div>
                </div>

                {{-- <div class="form-group">
                    <label for="informe">Informe:</label>
                    <input type="checkbox" name="informe" id="informe">
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
                        @foreach ($grupo->alumnos as $alumno)
                            @php
                                $alumnoId = $alumno->id;
                            @endphp
                            <tr data-id="{{ $alumnoId }}">
                                <td>
                                    {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }} {{ $alumno->nombres }}
                                </td>
                                @foreach (['p' => 'Presente', 'f' => 'Falta', 't' => 'Tarde', 'j' => 'Justificado'] as $value => $label)
                                    <td class="input-cell">
                                        <label for="{{ $value }}_{{ $alumnoId }}" class="input-label"></label>
                                        <input id="{{ $value }}_{{ $alumnoId }}" type="radio"
                                            name="asistencias[{{ $alumnoId }}]" value="{{ $value }}"
                                            {{ old('asistencias.' . $alumnoId) == $value ? 'checked' : '' }} required>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-right">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
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
                    Todo cambio hecho hasta ahora será descartado.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="{{ route('docente.grupos.show', $grupo) }}" class="btn btn-danger">Aceptar y Borrar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para escanear QR -->
    <div class="modal fade" id="scanModal" tabindex="-1" role="dialog" aria-labelledby="scanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scanModalLabel">Escanear QR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <div id="videoWrapper">
                        <video id="video" autoplay></video>
                        <div id="qrFrame">
                            <!-- Cuatro marcos en las esquinas -->
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de error -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">No hemos podido encontrar al alumno en la lista o ha habido un problema con la cámara
                        o código QR.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast de éxito -->
    <div class="modal fade" id="autoCloseModal" tabindex="-1" role="dialog" aria-labelledby="autoCloseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-success">
                <div class="modal-header" id="autoCloseModalLabel">
                    <h5 class="modal-title">PRESENTE!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <p class="mb-0">Asistencia marcada correctamente.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="position-fixed bottom-0 right-0 p-3" style="z-index: -10; right: 0; bottom: 0;">
        <div id="successToast" class="toast bg-success text-white" role="alert" aria-live="assertive"
            aria-atomic="true" data-delay="3000">
            <div class="toast-header">
                <strong class="mr-auto">Presente!</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body p-0">
                <div class="alert alert-success m-0 p-3" role="alert">
                    Asistencia marcada correctamente.
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@section('js')
    <script>
        $(function() {
            // Inicializa los tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Establece la fecha actual como valor por defecto en el campo de fecha
            var today = new Date().toISOString().split('T')[0];
            $('#fecha').val(today);
        });

        function formatTime(date) {
            const hours = date.getHours().toString().padStart(2, '0');
            const minutes = date.getMinutes().toString().padStart(2, '0');
            return `${hours}:${minutes}`;
        }

        const now = new Date();
        const currentTime = formatTime(now);

        // Establecer el valor del campo de entrada
        document.getElementById('hora').value = currentTime;
    </script>

    <script src="https://unpkg.com/@zxing/library@latest"></script>
    <script src="{{ asset('assets/js/qr.js') }}"></script>
@endsection
