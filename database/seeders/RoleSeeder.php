<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::create(['name' => 'admin']);
        $role_docente = Role::create(['name' => 'docente']);
        $role_apoderado = Role::create(['name' => 'apoderado']);

        $permissions_docente = [
            'docente.grupos.index',
            'docente.grupos.show',
            'docente.registros.create',
            'docente.registros.store',
            'docente.registros.edit',
            'docente.registros.update',
            'docente.registros.destroy',
        ];

        foreach ($permissions_docente as $permission) {
            Permission::create(['name' => $permission]);
            $role_docente->givePermissionTo($permission);
        }

        $user = User::find(1);
        $user->assignRole($role_admin);

        $user = User::find(2);
        $user->assignRole($role_docente);
        $user = User::find(3);
        $user->assignRole($role_docente);

        $user = User::find(4);
        $user->assignRole($role_apoderado);
        $user = User::find(5);
        $user->assignRole($role_apoderado);
        $user = User::find(6);
        $user->assignRole($role_apoderado);
        $user = User::find(7);
        $user->assignRole($role_apoderado);
        $user = User::find(8);
        $user->assignRole($role_apoderado);
    }
}
