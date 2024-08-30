<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }

    public function scopeSearch($query, $value)
    {
        $query->where('nombre', 'like', "%{$value}%")
            ->orWhere('descripcion', 'like', "%{$value}%");
    }
}
