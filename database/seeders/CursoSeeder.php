<?php

namespace Database\Seeders;

use App\Models\Curso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cursos = [
            [
                'nombre' => 'Matemáticas',
                'descripcion' => 'Curso de matemáticas básicas y avanzadas adaptadas al nivel de primaria.',
            ],
            [
                'nombre' => 'Comunicación',
                'descripcion' => 'Curso enfocado en la comprensión lectora, escritura y expresión oral.',
            ],
            [
                'nombre' => 'Ciencias Naturales',
                'descripcion' => 'Curso que introduce a los estudiantes a conceptos básicos de biología, física y química.',
            ],
            [
                'nombre' => 'Estudios Sociales',
                'descripcion' => 'Curso que cubre historia, geografía y cultura local y global.',
            ],
            [
                'nombre' => 'Razonamiento Matemático',
                'descripcion' => 'Curso dedicado al desarrollo de habilidades físicas y deportivas, así como a la promoción de la salud y el bienestar.',
            ],
        ];

        foreach ($cursos as $curso) {
            Curso::create($curso);
        }

        Curso::factory()->count(10)->create();
    }
}
