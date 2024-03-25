<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Proyecto;

class ProyectoPdfController extends Controller
{
    public function download(Proyecto $record)
    {
        // dd($record);

        $proyecto = Proyecto::find($record->id);
        $ejercido = $record->documentos->sum('importe');

        // vista que se encuentra en carpeta 'pdf' y vista proyecto.blade.php
        $pdf = Pdf::loadView('pdf.proyecto', compact('proyecto', 'ejercido'));
        // return $pdf->download('recibo.pdf');
        return $pdf->stream('proyecto.pdf');

    }
}
