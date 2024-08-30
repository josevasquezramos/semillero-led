<?php

namespace App\Livewire;

use App\Models\Alumno;
use App\Models\Grupo;
use App\Models\GrupoAlumno;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class GestionarGrupoAlumnos extends Component
{
    use WithPagination, LivewireAlert;

    public $grupo;
    public $alumno;
    public $alumnoSeleccionado;
    public $search = '';
    public $alumnosMatriculados;
    protected $queryString = ['search'];

    public $modal = false;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'deleteConfirmed'
    ];

    public function mount(Grupo $grupo)
    {
        $this->grupo = $grupo;
        $this->cargarAlumnosMatriculados();
    }

    public function create()
    {
        $this->openModal();
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

    public function cargarAlumnosMatriculados()
    {
        $this->alumnosMatriculados = $this->grupo->alumnos()->get();
    }

    public function matricular($alumnoId)
    {
        GrupoAlumno::create([
            'grupo_id' => $this->grupo->id,
            'alumno_id' => $alumnoId,
        ]);
        $this->cargarAlumnosMatriculados();
    }

    public function desmatricular($alumnoId)
    {
        $this->alumno = Alumno::find($alumnoId);

        $message = 'La matrícula del alumno '
            . $this->alumno->apellido_paterno . ' '
            . $this->alumno->apellido_materno . ' '
            . $this->alumno->nombres . ' será cancelada de manera definitiva. Por favor, ten en cuenta que la cancelación no podrá llevarse a cabo si existen registros relacionados a la matrícula.';

        $this->alert('warning', '¿Estás seguro de que quieres cancelar esta matrícula?', [
            'position' => 'center',
            'timer' => null,
            'toast' => false,
            'text' => $message,
            'showConfirmButton' => true,
            'confirmButtonText' => 'Sí, cancelar',
            'showCancelButton' => true,
            'cancelButtonText' => 'No, mantener',
            'onConfirmed' => 'deleteConfirmed',
            'onDismissed' => 'alertDismissed',
        ]);
    }

    public function deleteConfirmed()
    {
        try {
            GrupoAlumno::where('grupo_id', $this->grupo->id)
                ->where('alumno_id', $this->alumno->id)
                ->delete();
            $this->cargarAlumnosMatriculados();
        } catch (\Exception $e) {
            $this->alert('error', 'Error al cancelar la matrícula', [
                'position' => 'center',
                'timer' => null,
                'toast' => false,
                'text' => 'La matrícula no se puede cancelar porque existen registros relacionados o vinculaciones asociadas a él.',
                'onDismissed' => '',
                'timer' => null,
                'showCancelButton' => true,
                'cancelButtonText' => 'Entendido',
                'onDismissed' => 'alertDismissed',
            ]);
        }
        $this->clearModal();
    }

    public function render()
    {
        $alumnosDisponibles = Alumno::whereNotIn('id', $this->alumnosMatriculados->pluck('id'))
            ->where(function ($query) {
                $query->where('nombres', 'like', '%' . $this->search . '%')
                    ->orWhere('apellido_paterno', 'like', '%' . $this->search . '%')
                    ->orWhere('apellido_materno', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.grupo-alumnos.gestionar-grupo-alumnos', [
            'alumnosDisponibles' => $alumnosDisponibles,
        ]);
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
        $this->search = '';
        $this->resetErrorBag();
        $this->resetPage();
    }
}
