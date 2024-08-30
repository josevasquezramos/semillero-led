<?php

namespace App\Livewire;

use App\Models\Curso;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Cursos extends Component
{
    use WithPagination, LivewireAlert;

    public $curso;
    public $id_curso, $nombre, $descripcion;
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
        return view('livewire.cursos.index', [
            'cursos' => Curso::search($this->search)
                ->orderBy($this->sortColumn, $this->sortDirection)
                ->paginate($this->perPage)
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
            'descripcion' => 'required|string',
        ];

        $validatedData = $this->validate($rules);

        Curso::updateOrCreate(
            ['id' => $this->id_curso],
            $validatedData
        );

        $type = $this->id_curso ? 'actualizado' : 'creado';
        $title = 'Curso ' . $type . ' correctamente';
        $message = 'El curso ' . $this->nombre . ' fue ' . $type . ' correctamente.';

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
        $curso = Curso::findOrFail($id);
        $this->id_curso = $id;
        $this->nombre = $curso->nombre;
        $this->descripcion = $curso->descripcion;
        $this->openModal();
    }

    public function delete($id)
    {
        $this->curso = Curso::find($id);

        $message = 'El curso ' . $this->curso->nombre . ' será eliminado de manera definitiva. Por favor, ten en cuenta que la eliminación no podrá llevarse a cabo si existen registros relacionados al curso.';

        $this->alert('warning', '¿Estás seguro de que quieres eliminar este curso?', [
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
            $this->curso->delete();

            $this->alert('success', 'Curso eliminado exitosamente', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'text' => 'El curso ' . $this->curso->nombre . ' fue eliminado exitosamente.',
                'onDismissed' => '',
            ]);
        } catch (\Exception $e) {
            $this->alert('error', 'Error al eliminar curso', [
                'position' => 'center',
                'timer' => null,
                'toast' => false,
                'text' => 'El curso ' . $this->curso->nombre . ' no se puede eliminar porque existen registros relacionados o vinculaciones asociadas a él.',
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
        $this->reset(['curso', 'id_curso', 'nombre', 'descripcion']);
        $this->resetErrorBag();
    }
}
