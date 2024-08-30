<?php

namespace Database\Seeders;

use App\Models\Registro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegistroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registros = [
            ['grupo_id' => '1', 'fecha' => '2023-03-1', 'hora' => '10:00:00', 'informe' => true],
            ['grupo_id' => '1', 'fecha' => '2023-03-2', 'hora' => '12:00:00', 'informe' => true],
            ['grupo_id' => '2', 'fecha' => '2024-03-1', 'hora' => '08:00:00', 'informe' => true],
        ];

        foreach ($registros as $registro) {
            Registro::create($registro);
        }
    }
}
