<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'curso_id',
        'grado_id',
        'periodo_id',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }

    public function grupoAlumnos()
    {
        return $this->hasMany(GrupoAlumno::class, 'grupo_id');
    }

    public function grupoDocentes()
    {
        return $this->hasMany(GrupoDocente::class);
    }

    public function registros()
    {
        return $this->hasMany(Registro::class, 'grupo_id');
    }

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'grupo_alumnos', 'grupo_id', 'alumno_id')
            ->orderBy('apellido_paterno');
    }

    public function docentes()
    {
        return $this->belongsToMany(User::class, 'grupo_docentes', 'grupo_id', 'user_id');
    }

    public function scopeSearch($query, $value)
    {
        $query->where('nombre', 'like', "%{$value}%")
            ->orWhereHas('curso', function ($q) use ($value) {
                $q->where('nombre', 'like', "%{$value}%");
            })
            ->orWhereHas('grado', function ($q) use ($value) {
                $q->where('nombre', 'like', "%{$value}%");
            })
            ->orWhereHas('periodo', function ($q) use ($value) {
                $q->where('nombre', 'like', "%{$value}%");
            });
    }
}
