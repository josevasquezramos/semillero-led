<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $fillable = [
        'grupo_id',
        'fecha',
        'hora',
        'informe',
    ];

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }
}
