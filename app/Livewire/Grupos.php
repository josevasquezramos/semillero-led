<?php

namespace App\Livewire;

use App\Models\Grupo;
use App\Models\Curso;
use App\Models\Grado;
use App\Models\Periodo;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Grupos extends Component
{
    use WithPagination, LivewireAlert;

    public $grupo;
    public $id_grupo, $nombre, $curso_id, $grado_id, $periodo_id;
    public $modal = false;
    public $perPage = 10;
    public $search = '';
    public $sortDirection = 'DESC';
    public $sortColumn = 'id';

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'deleteConfirmed'
    ];

    public function render()
    {
        return view('livewire.grupos.index', [
            'grupos' => Grupo::with(['curso', 'grado', 'periodo'])
                ->search($this->search)
                ->orderBy($this->sortColumn, $this->sortDirection)
                ->paginate($this->perPage),
            'cursos' => Curso::all(),
            'grados' => Grado::all(),
            'periodos' => Periodo::all(),
        ]);
    }

    public function create()
    {
        $this->openModal();
        $this->clearModal();
    }

    public function save()
    {
        $rules = [
            'nombre' => 'required|string|max:255',
            'curso_id' => 'required|exists:cursos,id',
            'grado_id' => 'required|exists:grados,id',
            'periodo_id' => 'required|exists:periodos,id',
        ];

        $validatedData = $this->validate($rules);

        Grupo::updateOrCreate(
            ['id' => $this->id_grupo],
            $validatedData
        );

        $type = $this->id_grupo ? 'actualizado' : 'creado';
        $title = 'Grupo ' . $type . ' correctamente';
        $message = 'El grupo ' . $this->nombre . ' fue ' . $type . ' correctamente.';

        $this->closeModal();
        $this->clearModal();

        $this->alert('success', $title, [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
            'text' => $message,
            'onDismissed' => '',
        ]);
    }

    public function edit($id)
    {
        $grupo = Grupo::findOrFail($id);
        $this->id_grupo = $id;
        $this->nombre = $grupo->nombre;
        $this->curso_id = $grupo->curso_id;
        $this->grado_id = $grupo->grado_id;
        $this->periodo_id = $grupo->periodo_id;
        $this->openModal();
    }

    public function delete($id)
    {
        $this->grupo = Grupo::find($id);

        $message = 'El grupo ' . $this->grupo->nombre . ' será eliminado de manera definitiva. Por favor, ten en cuenta que la eliminación no podrá llevarse a cabo si existen registros relacionados al grupo.';

        $this->alert('warning', '¿Estás seguro de que quieres eliminar este grupo?', [
            'position' => 'center',
            'timer' => null,
            'toast' => false,
            'text' => $message,
            'showConfirmButton' => true,
            'confirmButtonText' => 'Sí, eliminar',
            'showCancelButton' => true,
            'cancelButtonText' => 'Cancelar',
            'onConfirmed' => 'deleteConfirmed',
            'onDismissed' => 'alertDismissed',
        ]);
    }

    public function deleteConfirmed()
    {
        try {
            $this->grupo->delete();

            $this->alert('success', 'Grupo eliminado exitosamente', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'text' => 'El grupo ' . $this->grupo->nombre . ' fue eliminado exitosamente.',
                'onDismissed' => '',
            ]);
        } catch (\Exception $e) {
            $this->alert('error', 'Error al eliminar grupo', [
                'position' => 'center',
                'timer' => null,
                'toast' => false,
                'text' => 'El grupo ' . $this->grupo->nombre . ' no se puede eliminar porque existen registros relacionados o vinculaciones asociadas a él.',
                'onDismissed' => '',
                'timer' => null,
                'showCancelButton' => true,
                'cancelButtonText' => 'Entendido',
                'onDismissed' => 'alertDismissed',
            ]);
        }
        $this->clearModal();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function doSort($column)
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = ($this->sortDirection == 'ASC') ? 'DESC' : 'ASC';
            return;
        }
        $this->sortColumn = $column;
        $this->sortDirection = 'ASC';
    }

    public function openModal()
    {
        $this->modal = true;
    }

    public function closeModal()
    {
        $this->modal = false;
        $this->clearModal();
    }

    public function clearModal()
    {
        $this->reset(['grupo', 'id_grupo', 'nombre', 'curso_id', 'grado_id', 'periodo_id']);
        $this->resetErrorBag();
    }
}
