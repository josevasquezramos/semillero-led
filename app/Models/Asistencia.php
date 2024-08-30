<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'registro_id',
        'grupo_alumno_id',
        'asistio',
    ];

    public function registro()
    {
        return $this->belongsTo(Registro::class);
    }

    public function grupoAlumno()
    {
        return $this->belongsTo(GrupoAlumno::class);
    }
}
