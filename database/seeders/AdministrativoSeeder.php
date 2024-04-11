<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdministrativoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administrativo = [
            ['expediente' => 12345, 
            'nombre' => 'Li.c Ivonne López García',
            ],
        ];

        DB::table('administrativos')->insert($administrativo);
    }
}
