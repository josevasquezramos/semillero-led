@section('content_header')
    @include('adminlte::partials.common.header', [
        'icon' => 'fas fa-fw fa-clipboard-list',
        'title' => 'Matrículas - ' . $grupo->nombre,
    ])
@endsection

<div>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6 text-left">
                    <a href="{{ route('admin.grupos') }}" class="btn btn-secondary">
                        Retroceder
                    </a>
                </div>
                <div class="col-6 text-right">
                    <button wire:click='create()' class="btn btn-primary">
                        <i class="fas fa-fw fa-clipboard-list mr-1"></i>
                        Matricular
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($alumnosMatriculados->isEmpty())
                <div class="d-flex justify-content-center align-items-center py-5 my-5 text-center">
                    <div>
                        <i class="fas fa-exclamation-circle fa-4x mb-3 text-secondary"></i>
                        <h5 class="text-secondary px-5">
                            Aún no hay alumnos matriculados en este grupo.
                        </h5>
                    </div>
                </div>
            @else
                @php
                    $i = 1;
                @endphp
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">N°</th>
                                <th>Dni</th>
                                <th>Alumno</th>
                                <th>Fecha y Hora</th>
                                <th class="text-center">Desmatricular</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alumnosMatriculados as $alumno)
                                <tr>
                                    <td class="text-center align-middle">{{ $i }}</td>
                                    <td class="align-middle">{{ $alumno->dni }}</td>
                                    <td class="text-truncate align-middle" style="min-width: 230px">
                                        {{ $alumno->apellido_paterno }}
                                        {{ $alumno->apellido_materno }}
                                        {{ $alumno->nombres }}</td>
                                    <td style="min-width: 160px">{{ $alumno->grupoAlumno($grupo->id)->created_at }}</td>
                                    <td class="text-center align-middle">
                                        <button wire:click="desmatricular({{ $alumno->id }})"
                                            class="btn btn-sm btn-danger">
                                            <i class="fas fa-user-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    @if ($modal)
        @include('livewire.grupo-alumnos.modal')
    @endif
</div>
