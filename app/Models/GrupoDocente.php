<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoDocente extends Model
{
    use HasFactory;

    protected $fillable = [
        'grupo_id',
        'user_id',
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
