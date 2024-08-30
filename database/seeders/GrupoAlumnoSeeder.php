<?php

namespace Database\Seeders;

use App\Models\GrupoAlumno;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GrupoAlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grupoAlumnos = [
            ['grupo_id' => 1, 'alumno_id' => 1,],
            ['grupo_id' => 1, 'alumno_id' => 2,],
            ['grupo_id' => 1, 'alumno_id' => 3,],
            ['grupo_id' => 1, 'alumno_id' => 4,],
            ['grupo_id' => 1, 'alumno_id' => 5,],

            ['grupo_id' => 2, 'alumno_id' => 1,],
            ['grupo_id' => 2, 'alumno_id' => 2,],
            ['grupo_id' => 2, 'alumno_id' => 3,],
            ['grupo_id' => 2, 'alumno_id' => 4,],
            ['grupo_id' => 2, 'alumno_id' => 5,],
            
            ['grupo_id' => 3, 'alumno_id' => 6,],
            ['grupo_id' => 3, 'alumno_id' => 7,],
            ['grupo_id' => 3, 'alumno_id' => 8,],
            ['grupo_id' => 3, 'alumno_id' => 9,],
            ['grupo_id' => 3, 'alumno_id' => 10,],
            
            ['grupo_id' => 4, 'alumno_id' => 6,],
            ['grupo_id' => 4, 'alumno_id' => 7,],
            ['grupo_id' => 4, 'alumno_id' => 8,],
            ['grupo_id' => 4, 'alumno_id' => 9,],
            ['grupo_id' => 4, 'alumno_id' => 10,],

            
            ['grupo_id' => 5, 'alumno_id' => 1,],
            ['grupo_id' => 5, 'alumno_id' => 8,],
        ];

        foreach ($grupoAlumnos as $grupoAlumno) {
            GrupoAlumno::create($grupoAlumno);
        }
    }
}
