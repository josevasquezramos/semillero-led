<div class="modal-backdrop fade show"></div>

<div class="modal fade show" tabindex="10" role="dialog" aria-labelledby="exampleModalLabel" style="display: block;">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Matrícula de alumnos</h5>
                <button wire:click='closeModal()' type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-header">
                <input class="form-control" type="text" wire:model.live.debounce.500ms="search"
                    placeholder="Buscar alumno..." />
            </div>

            @if ($alumnosDisponibles->isNotEmpty())
                <div class="modal-body">
                    <table class="table table-sm table-bordered table-striped table-hover">
                        <tbody>
                            @foreach ($alumnosDisponibles as $alumno)
                                <tr>
                                    <td class="text-truncate align-middle">
                                        {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}
                                        {{ $alumno->nombres }}
                                    </td>
                                    <td class="text-truncate align-middle text-center">
                                        <button wire:click="matricular({{ $alumno->id }})"
                                            class="btn btn-sm btn-success">
                                            <i class="fas fa-user-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $alumnosDisponibles->links() }}
                </div>
            @else
                <div class="modal-body">
                    <p>No se encontraron alumnos.</p>
                </div>
            @endif
        </div>
    </div>
</div>
</div>
