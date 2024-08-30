<?php

namespace Database\Seeders;

use App\Models\GrupoDocente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GrupoDocenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grupoDocentes = [
            ['grupo_id' => 1, 'user_id' => 2,],
            ['grupo_id' => 2, 'user_id' => 3,],
            ['grupo_id' => 3, 'user_id' => 2,],
            ['grupo_id' => 4, 'user_id' => 3,],
            ['grupo_id' => 5, 'user_id' => 2,],
        ];

        foreach ($grupoDocentes as $grupoDocente) {
            GrupoDocente::create($grupoDocente);
        }
    }
}
