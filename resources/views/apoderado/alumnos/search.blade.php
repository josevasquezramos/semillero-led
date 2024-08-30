@extends('adminlte::page')

@section('content_header')
    @include('adminlte::partials.common.header', [
        'icon' => 'fas fa-user-graduate',
        'title' => 'Buscar alumno por DNI',
    ])
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('apoderado.alumnos.search') }}" method="POST" class="form-inline d-flex w-100">
                @csrf
                <div class="input-group mb-2 flex-grow-1">
                    <input type="text" id="dni" name="dni" value="{{ old('dni') }}" required
                        class="form-control" placeholder="Buscar por DNI ...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search mr-1"></i> Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Muestra los errores, si los hay --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Muestra mensajes de éxito, si los hay --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Si se encuentra un alumno, muestra sus detalles y el botón para agregar apoderado --}}
    @isset($alumno)
        <div class="card mt-3">
            <div class="card-header">
                <span class="card-title">Resultado</span>
            </div>
            <div class="card-body">
                <p class="card-text mb-0"><strong>Alumno:</strong> {{ $alumno->nombres }} {{ $alumno->apellido_paterno }}
                    {{ $alumno->apellido_materno }}</p>
                <p class="card-text"><strong>DNI:</strong> {{ $alumno->dni }}</p>
                <hr>
                <p class="card-text mb-0">
                    El alumno será agregado bajo su tutela y recibirá notificaciones en su correo electrónico relacionadas con
                    su asistencia a las clases.
                </p>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('apoderado.alumnos.addApoderado', $alumno->id) }}" class="btn btn-success">Agregar bajo mi tutela</a>
            </div>
        </div>
    @endisset
@endsection
