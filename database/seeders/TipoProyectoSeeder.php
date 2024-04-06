<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoProyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            ['nombre' => 'Convencionales'],
            ['nombre' => 'Estratégicos de Investigación'],
            ['nombre' => 'Desarrollo de Tecnología'],
            ['nombre' => 'Estratégicos Institucionales'],
            ['nombre' => 'Gastos de Administración de Investigación'],
            ['nombre' => 'Fondo Concurrente Para Proyectos Externos'],
            ['nombre' => 'Apoyo a Congresos'],
            ['nombre' => 'Subproyectos del Fondo Concurrente'],
            ['nombre' => 'Pronaces (EIP)'],
        ];

        DB::table('tipo_proyectos')->insert($tipos);
    }
}
