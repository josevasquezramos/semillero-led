<?php

namespace Database\Seeders;

use App\Models\Alumno;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alumnos = [
            [
                'dni' => '12345678',
                'apellido_paterno' => 'Gonzalez',
                'apellido_materno' => 'Fernandez',
                'nombres' => 'Juan Carlos',
                'fecha_nacimiento' => '2015-01-01',
                'direccion' => 'Av. Siempre Viva 123',
                'telefono_emergencias' => '911234567',
            ],
            [
                'dni' => '23456789',
                'apellido_paterno' => 'Martinez',
                'apellido_materno' => 'Lopez',
                'nombres' => 'Maria Elena',
                'fecha_nacimiento' => '2015-05-15',
                'direccion' => 'Calle Falsa 456',
                'telefono_emergencias' => '911234568',
            ],
            [
                'dni' => '34567890',
                'apellido_paterno' => 'Perez',
                'apellido_materno' => 'Sanchez',
                'nombres' => 'Luis Fernando',
                'fecha_nacimiento' => '2015-08-22',
                'direccion' => 'Calle Verdadera 789',
                'telefono_emergencias' => '911234569',
            ],
            [
                'dni' => '45678901',
                'apellido_paterno' => 'Gomez',
                'apellido_materno' => 'Ramirez',
                'nombres' => 'Ana Maria',
                'fecha_nacimiento' => '2015-03-10',
                'direccion' => 'Plaza Mayor 321',
                'telefono_emergencias' => '911234570',
            ],
            [
                'dni' => '56789012',
                'apellido_paterno' => 'Castro',
                'apellido_materno' => 'Hernandez',
                'nombres' => 'Carlos Alberto',
                'fecha_nacimiento' => '2015-11-30',
                'direccion' => 'Plaza de San Luis 909',
                'telefono_emergencias' => '911234571',
            ],
            [
                'dni' => '67890123',
                'apellido_paterno' => 'Ramirez',
                'apellido_materno' => 'Jimenez',
                'nombres' => 'Laura Beatriz',
                'fecha_nacimiento' => '2015-02-28',
                'direccion' => 'Calle del Sol 100',
                'telefono_emergencias' => '911234572',
            ],
            [
                'dni' => '78901234',
                'apellido_paterno' => 'Vargas',
                'apellido_materno' => 'Morales',
                'nombres' => 'Sergio Alejandro',
                'fecha_nacimiento' => '2015-09-10',
                'direccion' => 'Avenida Central 202',
                'telefono_emergencias' => '911234573',
            ],
            [
                'dni' => '89012345',
                'apellido_paterno' => 'Lopez',
                'apellido_materno' => 'Paredes',
                'nombres' => 'Claudia Isabel',
                'fecha_nacimiento' => '2015-12-15',
                'direccion' => 'Calle Luna 303',
                'telefono_emergencias' => '911234574',
            ],
            [
                'dni' => '90123456',
                'apellido_paterno' => 'Cruz',
                'apellido_materno' => 'Gonzalez',
                'nombres' => 'David Alejandro',
                'fecha_nacimiento' => '2015-07-25',
                'direccion' => 'Plaza de Armas 404',
                'telefono_emergencias' => '911234575',
            ],
            [
                'dni' => '87654321',
                'apellido_paterno' => 'Jaramillo',
                'apellido_materno' => 'Vega',
                'nombres' => 'Natalia Andrea',
                'fecha_nacimiento' => '2015-10-05',
                'direccion' => 'Avenida Libertad 505',
                'telefono_emergencias' => '911234576',
            ],
            /*
            [
                'dni' => '76543210',
                'apellido_paterno' => 'Serrano',
                'apellido_materno' => 'Salazar',
                'nombres' => 'Felipe Ernesto',
                'fecha_nacimiento' => '2015-06-15',
                'direccion' => 'Calle del Lago 606',
                'telefono_emergencias' => '911234577',
            ],
            [
                'dni' => '65432109',
                'apellido_paterno' => 'Valencia',
                'apellido_materno' => 'Lozano',
                'nombres' => 'Daniela Marcela',
                'fecha_nacimiento' => '2015-11-20',
                'direccion' => 'Avenida Norte 707',
                'telefono_emergencias' => '911234578',
            ],
            [
                'dni' => '54321098',
                'apellido_paterno' => 'Mendoza',
                'apellido_materno' => 'Rivas',
                'nombres' => 'Andres Felipe',
                'fecha_nacimiento' => '2015-04-30',
                'direccion' => 'Calle del Mar 808',
                'telefono_emergencias' => '911234579',
            ],
            [
                'dni' => '43210987',
                'apellido_paterno' => 'Calle',
                'apellido_materno' => 'Bermudez',
                'nombres' => 'Mariana Alejandra',
                'fecha_nacimiento' => '2015-05-10',
                'direccion' => 'Avenida Libertad 654',
                'telefono_emergencias' => '911234580',
            ],
            [
                'dni' => '32109876',
                'apellido_paterno' => 'Ospina',
                'apellido_materno' => 'Torres',
                'nombres' => 'Julian Esteban',
                'fecha_nacimiento' => '2015-03-22',
                'direccion' => 'Calle Principal 101',
                'telefono_emergencias' => '911234581',
            ],
            */
        ];

        foreach ($alumnos as $alumno) {
            Alumno::create($alumno);
        }

        Alumno::factory()->count(500)->create();
    }
}
