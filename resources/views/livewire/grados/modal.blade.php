<div class="modal-backdrop fade show"></div>

<div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: block;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form wire:submit.prevent="save">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $id_grado ? 'Editar Grado' : 'Crear Grado' }}</h5>
                    <button wire:click='closeModal()' type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input wire:model='nombre' type="text"
                            class="form-control @error('nombre') is-invalid @enderror" id="nombre"
                            placeholder="Ingrese el nombre del grado" required>
                        @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button wire:click='closeModal()' type="button" class="btn btn-secondary">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
