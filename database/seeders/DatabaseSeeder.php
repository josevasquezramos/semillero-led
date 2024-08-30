<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);

        $this->call(AlumnoSeeder::class);
        $this->call(PeriodoSeeder::class);
        $this->call(GradoSeeder::class);
        $this->call(CursoSeeder::class);
        $this->call(GrupoSeeder::class);
        $this->call(GrupoAlumnoSeeder::class);
        $this->call(GrupoDocenteSeeder::class);

        $this->call(RegistroSeeder::class);
        $this->call(AsistenciaSeeder::class);
        $this->call(ApoderadoSeeder::class);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
