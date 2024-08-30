<?php

namespace Database\Seeders;

use App\Models\Periodo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $periodos = [
            [
                'nombre' => 'Año escolar 2023',
                'descripcion' => 'Periodo correspondiente al año 2023.',
                'fecha_inicio' => '2023-03-01',
                'fecha_fin' => '2023-12-31',
                'estado' => 'culminado',
            ],
            [
                'nombre' => 'Año escolar 2024',
                'descripcion' => 'Periodo correspondiente al año 2024.',
                'fecha_inicio' => '2024-03-01',
                'fecha_fin' => '2024-12-31',
                'estado' => 'activo',
            ],
        ];

        foreach ($periodos as $periodo) {
            Periodo::create($periodo);
        }
    }
}
