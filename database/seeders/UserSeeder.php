<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Administrador',
                'phone' => '987654321',
                'email' => 'admin@led.uns',
                'password' => Hash::make('12345678'),
                // 'role' => 'admin',
            ],
            [
                'name' => 'Docente 1',
                'phone' => '976543210',
                'email' => 'docente1@led.uns',
                'password' => Hash::make('12345678'),
                // 'role' => 'docente',
            ],
            [
                'name' => 'Docente 2',
                'phone' => '965432109',
                'email' => 'docente2@led.uns',
                'password' => Hash::make('12345678'),
                // 'role' => 'docente',
            ],
            [
                'name' => 'Padre de Familia 1',
                'phone' => '954321098',
                'email' => 'ppff1@gmail.com',
                'password' => Hash::make('12345678'),
                // 'role' => 'apoderado',
            ],
            [
                'name' => 'Padre de Familia 2',
                'phone' => '943210987',
                'email' => 'ppff2@gmail.com',
                'password' => Hash::make('12345678'),
                // 'role' => 'apoderado',
            ],
            [
                'name' => 'Padre de Familia 3',
                'phone' => '932109876',
                'email' => 'ppff3@gmail.com',
                'password' => Hash::make('12345678'),
                // 'role' => 'apoderado',
            ],
            [
                'name' => 'Padre de Familia 4',
                'phone' => '921098765',
                'email' => 'ppff4@gmail.com',
                'password' => Hash::make('12345678'),
                // 'role' => 'apoderado',
            ],
            [
                'name' => 'Padre de Familia 5',
                'phone' => '910987654',
                'email' => 'ppff5@gmail.com',
                'password' => Hash::make('12345678'),
                // 'role' => 'apoderado',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
