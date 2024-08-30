<?php

namespace App\Livewire;

use App\Models\Grado;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Grados extends Component
{
    use WithPagination, LivewireAlert;

    public $grado;
    public $id_grado, $nombre;
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
        return view('livewire.grados.index', [
            'grados' => Grado::search($this->search)
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
        ];

        $validatedData = $this->validate($rules);

        Grado::updateOrCreate(
            ['id' => $this->id_grado],
            $validatedData
        );

        $type = $this->id_grado ? 'actualizado' : 'creado';
        $title = 'Grado ' . $type . ' correctamente';
        $message = 'El grado ' . $this->nombre . ' fue ' . $type . ' correctamente.';

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
        $grado = Grado::findOrFail($id);
        $this->id_grado = $id;
        $this->nombre = $grado->nombre;
        $this->openModal();
    }

    public function delete($id)
    {
        $this->grado = Grado::find($id);

        $message = 'El grado ' . $this->grado->nombre . ' será eliminado de manera definitiva. Por favor, ten en cuenta que la eliminación no podrá llevarse a cabo si existen registros relacionados al grado.';

        $this->alert('warning', '¿Estás seguro de que quieres eliminar este grado?', [
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
            $this->grado->delete();

            $this->alert('success', 'Grado eliminado exitosamente', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'text' => 'El grado ' . $this->grado->nombre . ' fue eliminado exitosamente.',
                'onDismissed' => '',
            ]);
        } catch (\Exception $e) {
            $this->alert('error', 'Error al eliminar grado', [
                'position' => 'center',
                'timer' => null,
                'toast' => false,
                'text' => 'El grado ' . $this->grado->nombre . ' no se puede eliminar porque existen registros relacionados o vinculaciones asociadas a él.',
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
        $this->reset(['grado', 'id_grado', 'nombre']);
        $this->resetErrorBag();
    }
}
