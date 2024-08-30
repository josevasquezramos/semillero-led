<?php

namespace App\Livewire;

use App\Models\Periodo;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Periodos extends Component
{
    use WithPagination, LivewireAlert;

    public $periodo;
    public $id_periodo, $nombre, $descripcion, $fecha_inicio, $fecha_fin, $estado;
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
        return view('livewire.periodos.index', [
            'periodos' => Periodo::search($this->search)
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
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'estado' => 'required|in:activo,culminado',
        ];

        $validatedData = $this->validate($rules);

        Periodo::updateOrCreate(
            ['id' => $this->id_periodo],
            $validatedData
        );

        $type = $this->id_periodo ? 'actualizado' : 'creado';
        $title = 'Periodo ' . $type . ' correctamente';
        $message = 'El periodo ' . $this->nombre . ' fue ' . $type . ' correctamente.';

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
        $periodo = Periodo::findOrFail($id);
        $this->id_periodo = $id;
        $this->nombre = $periodo->nombre;
        $this->descripcion = $periodo->descripcion;
        $this->fecha_inicio = $periodo->fecha_inicio;
        $this->fecha_fin = $periodo->fecha_fin;
        $this->estado = $periodo->estado;
        $this->openModal();
    }

    public function delete($id)
    {
        $this->periodo = Periodo::find($id);

        $message = 'El periodo ' . $this->periodo->nombre . ' será eliminado de manera definitiva. Por favor, ten en cuenta que la eliminación no podrá llevarse a cabo si existen registros relacionados al periodo.';

        $this->alert('warning', '¿Estás seguro de que quieres eliminar este periodo?', [
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
            $this->periodo->delete();

            $this->alert('success', 'Periodo eliminado exitosamente', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'text' => 'El periodo ' . $this->periodo->nombre . ' fue eliminado exitosamente.',
                'onDismissed' => '',
            ]);
        } catch (\Exception $e) {
            $this->alert('error', 'Error al eliminar periodo', [
                'position' => 'center',
                'timer' => null,
                'toast' => false,
                'text' => 'El periodo ' . $this->periodo->nombre . ' no se puede eliminar porque existen registros relacionados o vinculaciones asociadas a él.',
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
        $this->reset([
            'periodo',
            'id_periodo',
            'nombre',
            'descripcion',
            'fecha_inicio',
            'fecha_fin',
            'estado'
        ]);
        $this->resetErrorBag();
    }
}
