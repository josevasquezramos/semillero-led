@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/personal-table.css') }}">
@endsection

@section('content_header')
    @include('adminlte::partials.common.header', [
        'icon' => 'fas fa-fw fa-book',
        'title' => 'Cursos',
    ])
@endsection

<div>

    @if ($modal)
        @include('livewire.cursos.modal')
    @endif

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6 text-left">

                </div>
                <div class="col-6 text-right">
                    <button wire:click='create()' class="btn btn-primary">
                        <i class="fa fa-folder-plus mr-1"></i>
                        Crear
                    </button>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col-5 col-sm-5 col-md-4 col-lg-3">
                    <div class="input-group">
                        <div class="input-group-prepend d-none d-sm-block">
                            <span class="input-group-text">Por Página</span>
                        </div>
                        <select class="form-control" wire:model.live='perPage'>
                            <option value="5">5</option>
                            <option selected>10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>
                <div class="d-none d-sm-block col-sm-1 col-md-3 col-lg-5"></div>
                <div class="col-7 col-sm-6 col-md-5 col-lg-4 text-right">
                    <div class="input-group">
                        <input wire:model.live.debounce.500ms='search' type="text" class="form-control"
                            placeholder="Buscar...">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-hover table-bordered mb-0" style="width:100%">
                    <thead>
                        <tr>
                            <th wire:click="doSort('id')" class="cursor-pointer">
                                <x-datatable-item :sortColumn="$sortColumn" :sortDirection="$sortDirection" columnName="id" />
                            </th>
                            <th wire:click="doSort('nombre')" class="cursor-pointer">
                                <x-datatable-item :sortColumn="$sortColumn" :sortDirection="$sortDirection" columnName="nombre" />
                            </th>
                            <th wire:click="doSort('descripcion')" class="cursor-pointer">
                                <x-datatable-item :sortColumn="$sortColumn" :sortDirection="$sortDirection" columnName="descripcion" />
                            </th>
                            <th class="text-center" style="min-width: 100px">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cursos as $curso)
                            <tr>
                                <td class="text-center align-middle">{{ $curso->id }}</td>
                                <td class="text-truncate align-middle" style="max-width: 120px">{{ $curso->nombre }}
                                </td>
                                <td class="text-truncate align-middle" style="max-width: 180px">
                                    {{ $curso->descripcion }}</td>
                                <td class="text-center align-middle">
                                    <a wire:click='edit({{ $curso->id }})' class="btn btn-sm btn-warning mr-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a wire:click='delete({{ $curso->id }})' class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $cursos->links() }}
        </div>
    </div>
</div>

{{--
@script
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap4.js"></script>
@endscript
@script
    <script>
        alert("hola");
        new DataTable('#cursos-table', {
            responsive: true
        });
    </script>
@endscript
--}}

{{--
<td class="text-center align-middle py-0">
    <div class="btn-group">
        <button type="button" class="btn btn-sm" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-ellipsis-v text-gray mr-2"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <button type="button" wire:click='edit({{ $curso->id }})'
                class="dropdown-item">Editar</button>
            <button type="button" wire:click='delete({{ $curso->id }})'
                class="dropdown-item">Eliminar</button>
        </div>
    </div>
</td>
--}}
