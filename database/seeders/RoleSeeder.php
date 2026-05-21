<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role; 
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Creamos los roles en la base de datos vacía
        $adminRole = Role::create(['name' => 'admin']);
        Role::create(['name' => 'editor']);
        Role::create(['name' => 'viewer']);

        // 2. Creamos al usuario administrador
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@ejemplo.com',
            'password' => bcrypt('password') 
        ]);

        // 3. Le asignamos el rol usando la relación nativa de Laravel
        $adminUser->roles()->attach($adminRole->id);
    }
}