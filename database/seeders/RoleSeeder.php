<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role; // <-- Importamos tu modelo Role

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Creamos los 3 roles de tu práctica
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'editor']);
        Role::create(['name' => 'viewer']);
    }
}