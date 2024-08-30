<?php

namespace Database\Seeders;

use App\Models\Grupo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grupos = [
            [
                'nombre' => 'Tercero de Primaria - Matemáticas - Grupo A',
                'curso_id' => 1,
                'grado_id' => 3,
                'periodo_id' => 1,
            ],
            [
                'nombre' => 'Cuarto de Primaria - Comunicación - Grupo A',
                'curso_id' => 2,
                'grado_id' => 4,
                'periodo_id' => 2,
            ],
            [
                'nombre' => 'Quinto de Primaria - Ciencia - Grupo A',
                'curso_id' => 3,
                'grado_id' => 5,
                'periodo_id' => 2,
            ],
            [
                'nombre' => 'Quinto de Primaria - Estudios Sociales - Grupo A',
                'curso_id' => 4,
                'grado_id' => 5,
                'periodo_id' => 2,
            ],
            
            [
                'nombre' => 'Grupo para probar notificaciones',
                'curso_id' => 5,
                'grado_id' => 5,
                'periodo_id' => 2,
            ],
        ];

        foreach ($grupos as $grupo) {
            Grupo::create($grupo);
        }
    }
}
