<?php

namespace Database\Seeders;

use App\Models\Ubpp;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UbppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ubpps = [
            ['ubpp' => 1, 'nombre' => 'Rectoría'],
            ['ubpp' => 2, 'nombre' => 'Dirección de Administración'],
            ['ubpp' => 3, 'nombre' => 'Dirección de Académica'],
            ['ubpp' => 4, 'nombre' => 'Dirección de Patronato Universitario'],
            ['ubpp' => 5, 'nombre' => 'División de Ciencias Forestales'],
            ['ubpp' => 6, 'nombre' => 'División de Ciencias Económico Administrativas'],
            ['ubpp' => 7, 'nombre' => 'Fitotecnia'],
            ['ubpp' => 8, 'nombre' => 'Ingeniería Agroindustrial'],
            ['ubpp' => 9, 'nombre' => 'Irrigación'],
            ['ubpp' => 10, 'nombre' => 'Parasitología Agrícola'],
            ['ubpp' => 11, 'nombre' => 'Preparatoria Agrícola'],
            ['ubpp' => 12, 'nombre' => 'Sociología Rural'],
            ['ubpp' => 13, 'nombre' => 'Suelos'],
            ['ubpp' => 14, 'nombre' => 'Zootecnia'],
            ['ubpp' => 15, 'nombre' => 'Zonas Áridas'],
            ['ubpp' => 16, 'nombre' => 'Subdirección de Apoyo Académico'],
            ['ubpp' => 17, 'nombre' => 'Campo Agrícola Experimental'],
            ['ubpp' => 18, 'nombre' => 'Centro Regional Anahuac - CRUAN'],
            ['ubpp' => 19, 'nombre' => 'Dirección de Difusión Cultural'],
            ['ubpp' => 20, 'nombre' => 'Departamento de Educación Física'],
            ['ubpp' => 22, 'nombre' => 'Centro de Idiomas'],
            ['ubpp' => 23, 'nombre' => 'Ingeniería Mecánica Agrícola'],
            ['ubpp' => 24, 'nombre' => 'Proyectos y Construcciones'],
            ['ubpp' => 26, 'nombre' => 'Subdirección de Servicios Generales'],
            ['ubpp' => 27, 'nombre' => 'Coordinación de Estudios de Posgrado'],
            ['ubpp' => 29, 'nombre' => 'Subdirección de Recursos Humanos'],
            ['ubpp' => 30, 'nombre' => 'Subdirección de Recursos Materiales'],
            ['ubpp' => 31, 'nombre' => 'Subdirección de Servicios Asistenciales'],
            ['ubpp' => 32, 'nombre' => 'Dirección de Investigación y Posgrado'],
            ['ubpp' => 33, 'nombre' => 'U.P.O.M.'],
            ['ubpp' => 34, 'nombre' => 'Dirección de Centros Regionales'],
            ['ubpp' => 35, 'nombre' => 'CRUO - Huatusco, Veracruz'],
            ['ubpp' => 36, 'nombre' => 'CRUS - Oaxaca, Oaxaca'],
            ['ubpp' => 37, 'nombre' => 'CRUNO - Obregón, Sonora'],
            ['ubpp' => 38, 'nombre' => 'CRUPY- Mérida, Yucatán'],
            ['ubpp' => 39, 'nombre' => 'CRUCO - Morelia, Michoacán'],
            ['ubpp' => 40, 'nombre' => 'CRUSE - Puyacatengo, Tabasco'],
            ['ubpp' => 43, 'nombre' => 'CRUCEN - Zacatecas, Zacatecas'],
            ['ubpp' => 45, 'nombre' => 'CRUOC - Guadalajara, Jalisco'],
            ['ubpp' => 46, 'nombre' => 'Contraloría General Interna'],
            ['ubpp' => 47, 'nombre' => 'C.I.E.S.T.A.A.M.'],
            ['ubpp' => 48, 'nombre' => 'Agroecología'],
        ];

        DB::table('ubpps')->insert($ubpps);

    }
}
