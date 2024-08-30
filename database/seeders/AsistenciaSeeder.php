<?php

namespace Database\Seeders;

use App\Models\Asistencia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsistenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $asistencias = [
            ['registro_id' => 1, 'grupo_alumno_id' => 1, 'asistio' => 'p'],
            ['registro_id' => 1, 'grupo_alumno_id' => 2, 'asistio' => 'f'],
            ['registro_id' => 1, 'grupo_alumno_id' => 3, 'asistio' => 'f'],
            ['registro_id' => 1, 'grupo_alumno_id' => 4, 'asistio' => 'p'],
            ['registro_id' => 1, 'grupo_alumno_id' => 5, 'asistio' => 'j'],
            
            ['registro_id' => 2, 'grupo_alumno_id' => 1, 'asistio' => 'p'],
            ['registro_id' => 2, 'grupo_alumno_id' => 2, 'asistio' => 'p'],
            ['registro_id' => 2, 'grupo_alumno_id' => 3, 'asistio' => 'f'],
            ['registro_id' => 2, 'grupo_alumno_id' => 4, 'asistio' => 'j'],
            ['registro_id' => 2, 'grupo_alumno_id' => 5, 'asistio' => 'p'],
            
            ['registro_id' => 3, 'grupo_alumno_id' => 6, 'asistio' => 'p'],
            ['registro_id' => 3, 'grupo_alumno_id' => 7, 'asistio' => 'p'],
            ['registro_id' => 3, 'grupo_alumno_id' => 8, 'asistio' => 'f'],
            ['registro_id' => 3, 'grupo_alumno_id' => 9, 'asistio' => 'j'],
            ['registro_id' => 3, 'grupo_alumno_id' => 10, 'asistio' => 'p'],
            ['registro_id' => 3, 'grupo_alumno_id' => 11, 'asistio' => 'j'],
        ];

        foreach ($asistencias as $asistencia) {
            Asistencia::create($asistencia);
        }
    }
}
