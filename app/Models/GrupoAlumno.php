<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoAlumno extends Model
{
    use HasFactory;

    protected $fillable = [
        'grupo_id',
        'alumno_id',
        'created_at'
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function alumno()
    {
        return $this->belongsTo(Alumno::class)->orderBy('apellido_paterno');
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}
