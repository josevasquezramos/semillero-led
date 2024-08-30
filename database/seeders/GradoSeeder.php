<?php

namespace Database\Seeders;

use App\Models\Grado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grados = [
            ['nombre' => 'Primer Grado de Primaria',],
            ['nombre' => 'Segundo Grado de Primaria',],
            ['nombre' => 'Tercer Grado de Primaria',],
            ['nombre' => 'Cuarto Grado de Primaria',],
            ['nombre' => 'Quinto Grado de Primaria',],
            ['nombre' => 'Sexto Grado de Primaria',],
        ];

        // Utiliza el modelo Grado para insertar los registros
        foreach ($grados as $grado) {
            Grado::create($grado);
        }
    }
}
