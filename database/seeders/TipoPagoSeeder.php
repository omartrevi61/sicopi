<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            ['nombre' => 'Recuperación'],
            ['nombre' => 'Pago a Proveedor'],
            ['nombre' => 'Gastos a Comprobar'],
            ['nombre' => 'Viáticos'],
            ['nombre' => 'Prácticas de Campo'],
            ['nombre' => 'Ayudantías'],
            ['nombre' => 'Nóminas'],
            ['nombre' => 'Requisiciones Externas'],
            ['nombre' => 'Transferencias'],
            ['nombre' => 'Recuperación DGIP'],
            ['nombre' => 'Nóminas (SNI)'],
            ['nombre' => 'Requisición Almacén General'],
            ['nombre' => 'UACh Gasto de Operación'],
            ['nombre' => 'UACh - DGIP'],
            ['nombre' => 'UACh - Reintegro de Gasto a Comprobar'],
        ];

        DB::table('tipo_pagos')->insert($tipos);
    }
}
