<?php

namespace Database\Seeders;

use App\Models\Apoderado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApoderadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grupoAlumnos = [
            ['user_id' => 4, 'alumno_id' => 1,],
            ['user_id' => 4, 'alumno_id' => 2,],
            ['user_id' => 4, 'alumno_id' => 3,],
            ['user_id' => 5, 'alumno_id' => 1,],
            ['user_id' => 5, 'alumno_id' => 2,],
            ['user_id' => 5, 'alumno_id' => 3,],
            ['user_id' => 6, 'alumno_id' => 4,],
            ['user_id' => 6, 'alumno_id' => 5,],
            ['user_id' => 6, 'alumno_id' => 6,],
            ['user_id' => 7, 'alumno_id' => 7,],
            ['user_id' => 7, 'alumno_id' => 8,],
            ['user_id' => 7, 'alumno_id' => 9,],
            ['user_id' => 8, 'alumno_id' => 10,],
        ];

        foreach ($grupoAlumnos as $grupoAlumno) {
            Apoderado::create($grupoAlumno);
        }
    }
}
