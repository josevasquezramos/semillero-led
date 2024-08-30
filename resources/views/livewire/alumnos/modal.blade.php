<!-- Modal backdrop -->
<div class="modal-backdrop fade show"></div>

<!-- Modal -->
<div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: block;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form wire:submit="save">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $id_alumno ? 'Editar Alumno' : 'Crear Alumno' }}</h5>
                    <button wire:click='closeModal()' type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- DNI -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dni">DNI</label>
                                <input wire:model='dni' type="text"
                                    class="form-control @error('dni') is-invalid @enderror" id="dni"
                                    placeholder="Ingrese el DNI del alumno" required>
                                @error('dni')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Apellido Paterno -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellido_paterno">Apellido Paterno</label>
                                <input wire:model='apellido_paterno' type="text"
                                    class="form-control @error('apellido_paterno') is-invalid @enderror"
                                    id="apellido_paterno" placeholder="Ingrese el apellido paterno" required>
                                @error('apellido_paterno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Apellido Materno -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellido_materno">Apellido Materno</label>
                                <input wire:model='apellido_materno' type="text"
                                    class="form-control @error('apellido_materno') is-invalid @enderror"
                                    id="apellido_materno" placeholder="Ingrese el apellido materno" required>
                                @error('apellido_materno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Nombres -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombres">Nombres</label>
                                <input wire:model='nombres' type="text"
                                    class="form-control @error('nombres') is-invalid @enderror" id="nombres"
                                    placeholder="Ingrese los nombres del alumno" required>
                                @error('nombres')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Fecha de Nacimiento -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                <input wire:model='fecha_nacimiento' type="date"
                                    class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                                    id="fecha_nacimiento" required>
                                @error('fecha_nacimiento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Dirección -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input wire:model='direccion' type="text"
                                    class="form-control @error('direccion') is-invalid @enderror" id="direccion"
                                    placeholder="Ingrese la dirección" required>
                                @error('direccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Teléfono de Emergencias -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono_emergencias">Teléfono de Emergencias</label>
                                <input wire:model='telefono_emergencias' type="text"
                                    class="form-control @error('telefono_emergencias') is-invalid @enderror"
                                    id="telefono_emergencias" placeholder="Ingrese el teléfono de emergencias" required>
                                @error('telefono_emergencias')
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
