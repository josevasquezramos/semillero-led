<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apoderado extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'alumno_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
}
