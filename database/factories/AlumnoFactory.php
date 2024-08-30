<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alumno>
 */
class AlumnoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $minDate = '2010-01-01'; // Fecha mínima
        $maxDate = '2018-12-31'; // Fecha máxima

        return [
            'dni' => $this->faker->unique()->numerify('########'),
            'apellido_paterno' => $this->faker->lastName,
            'apellido_materno' => $this->faker->lastName,
            'nombres' => $this->faker->firstName . ' ' . $this->faker->firstName,
            'fecha_nacimiento' => $this->faker->dateTimeBetween($minDate, $maxDate)->format('Y-m-d'),
            'direccion' => $this->faker->address,
            'telefono_emergencias' => $this->faker->phoneNumber,
        ];
    }
}
