@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/personal-table.css') }}">
@endsection

@section('content_header')
    @include('adminlte::partials.common.header', [
        'icon' => 'fas fa-fw fa-graduation-cap',
        'title' => 'Grados',
    ])
@endsection

<div>

    @if ($modal)
        @include('livewire.grados.modal')
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
                            <th class="text-center" style="min-width: 100px">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grados as $grado)
                            <tr>
                                <td class="text-center align-middle">{{ $grado->id }}</td>
                                <td class="text-truncate align-middle" style="max-width: 120px">{{ $grado->nombre }}
                                </td>
                                <td class="text-center align-middle">
                                    <a wire:click='edit({{ $grado->id }})' class="btn btn-sm btn-warning mr-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a wire:click='delete({{ $grado->id }})' class="btn btn-sm btn-danger">
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
            {{ $grados->links() }}
        </div>
    </div>
</div>
