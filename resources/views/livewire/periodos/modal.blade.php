<div class="modal-backdrop fade show"></div>

<div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: block;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form wire:submit.prevent="save">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $id_periodo ? 'Editar Periodo' : 'Crear Periodo' }}</h5>
                    <button wire:click='closeModal()' type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <!-- Columna para Nombre y Estado -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input wire:model='nombre' type="text"
                                    class="form-control @error('nombre') is-invalid @enderror" id="nombre"
                                    placeholder="Ingrese el nombre del período" required>
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <select wire:model='estado' id="estado"
                                    class="form-control @error('estado') is-invalid @enderror" required>
                                    <option value="">Seleccione un estado</option>
                                    <option value="activo">Activo</option>
                                    <option value="culminado">Culminado</option>
                                </select>
                                @error('estado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Columna para Fechas -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_inicio">Fecha de Inicio</label>
                                <input wire:model='fecha_inicio' type="date"
                                    class="form-control @error('fecha_inicio') is-invalid @enderror" id="fecha_inicio"
                                    required>
                                @error('fecha_inicio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_fin">Fecha de Fin</label>
                                <input wire:model='fecha_fin' type="date"
                                    class="form-control @error('fecha_fin') is-invalid @enderror" id="fecha_fin"
                                    required>
                                @error('fecha_fin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Columna para Descripción -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea wire:model='descripcion' class="form-control @error('descripcion') is-invalid @enderror" id="descripcion"
                                    rows="3" placeholder="Ingrese una descripción"></textarea>
                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
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
