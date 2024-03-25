<?php

namespace App\Exports;

use App\Models\Profesor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;


/**
* 14/diciembre/2023
* No estoy utilizando este procedimiento, lo quise usar pero solo sirve para Exportar todo el archivo de Profesores a tra´ves
* de un botón en la parte de arriba de mi formulario de Profesores
* En ves de esto instalé { composer require pxlrbt/filament-excel } que es más facil de usar y me permite exportar 
* solo los registros que yo quiera o todo el archivo
*/

class ProfesorsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $profesores = DB::table('profesors')
            ->join('ubpps as ubpp', 'ubpp.id', 'profesors.ubpp_id')
            ->select('profesors.expediente', 'profesors.nombre', 'profesors.apellidos', 'profesors.grado',
                 'profesors.email', 'profesors.telefono','ubpp.nombre as Departamento')
            ->orderBy('profesors.nombre')
            ->get();

            return $profesores;

            // dd($profesores);
            
    }

    public function headings(): array
    {
            return ['Expediente', 'Nombre', 'Apellidos', 'Grado', 'Email', 'Teléfono', 'Departamento'];
     
    }
}
