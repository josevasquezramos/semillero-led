<?php

namespace App\Livewire;

use App\Models\Alumno;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Alumnos extends Component
{
    use WithPagination, LivewireAlert;

    public $alumno;
    public $id_alumno, $dni, $apellido_paterno, $apellido_materno, $nombres, $fecha_nacimiento, $direccion, $telefono_emergencias;
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
        return view('livewire.alumnos.index', [
            'alumnos' => Alumno::search($this->search)
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
            'dni' => 'required|string|size:8|unique:alumnos,dni,' . $this->id_alumno,
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'nombres' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'direccion' => 'required|string|max:255',
            'telefono_emergencias' => 'required|string|max:20',
        ];

        $validatedData = $this->validate($rules);

        Alumno::updateOrCreate(
            ['id' => $this->id_alumno],
            $validatedData
        );

        $type = $this->id_alumno ? 'actualizado' : 'creado';
        $title = 'Alumno ' . $type . ' correctamente';
        $message = 'El alumno ' . $this->nombres . ' fue ' . $type . ' correctamente.';

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
        $alumno = Alumno::findOrFail($id);
        $this->id_alumno = $id;
        $this->dni = $alumno->dni;
        $this->apellido_paterno = $alumno->apellido_paterno;
        $this->apellido_materno = $alumno->apellido_materno;
        $this->nombres = $alumno->nombres;
        $this->fecha_nacimiento = $alumno->fecha_nacimiento;
        $this->direccion = $alumno->direccion;
        $this->telefono_emergencias = $alumno->telefono_emergencias;
        $this->openModal();
    }

    public function delete($id)
    {
        $this->alumno = Alumno::find($id);

        $message = 'El alumno ' . $this->alumno->nombres . ' será eliminado de manera definitiva. Por favor, ten en cuenta que la eliminación no podrá llevarse a cabo si existen registros relacionados al alumno.';

        $this->alert('warning', '¿Estás seguro de que quieres eliminar este alumno?', [
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
            $this->alumno->delete();

            $this->alert('success', 'Alumno eliminado exitosamente', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'text' => 'El alumno ' . $this->alumno->nombres . ' fue eliminado exitosamente.',
                'onDismissed' => '',
            ]);
        } catch (\Exception $e) {
            $this->alert('error', 'Error al eliminar alumno', [
                'position' => 'center',
                'timer' => null,
                'toast' => false,
                'text' => 'El alumno ' . $this->alumno->nombres . ' no se puede eliminar porque existen registros relacionados o vinculaciones asociadas a él.',
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
        $this->reset(['alumno', 'id_alumno', 'dni', 'apellido_paterno', 'apellido_materno', 'nombres', 'fecha_nacimiento', 'direccion', 'telefono_emergencias']);
        $this->resetErrorBag();
    }
}
