<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\ProfesorsExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Formato;

class ProfesorController extends Controller
{
    //
    public function excel()
    {
        return Excel::download(new ProfesorsExport, 'profesores.xlsx');
    }

    // no tiene caso obtener el pdf, sale bien feo sin formato etc.
/*    public function pdf()
    {
        return Excel::download(new ProfesorsExport, 'profesors.pdf', Formato::DOMPDF);
    } */
}
