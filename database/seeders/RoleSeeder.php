<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
     /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear rol de root si no existe
        Role::firstOrCreate(['name' => 'root']);
        
        // Otros roles que puedas necesitar
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'user']);
    }
}
