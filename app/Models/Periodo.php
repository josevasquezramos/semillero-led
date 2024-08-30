<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'estado',
    ];

    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }

    public function scopeSearch($query, $value)
    {
        $query->where('nombre', 'like', "%{$value}%")
            ->orWhere('descripcion', 'like', "%{$value}%")
            ->orWhere('fecha_inicio', 'like', "%{$value}%")
            ->orWhere('fecha_fin', 'like', "%{$value}%")
            ->orWhere('estado', 'like', "%{$value}%");
    }
}
