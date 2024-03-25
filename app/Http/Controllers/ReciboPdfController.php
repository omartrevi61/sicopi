<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recibo;

use Barryvdh\DomPDF\Facade\Pdf;

// Genera el ContraRecibo en formato PDF
//
class ReciboPdfController extends Controller
{
    public function download(Recibo $record)
    {
        // dd($record);

        $recibo = Recibo::find($record->id);

        $documentos = $recibo->documentos;

        $pdf = Pdf::loadView('pdf.contrarecibo', compact('recibo', 'documentos'));
        // return $pdf->download('recibo.pdf');
        return $pdf->stream('recibo.pdf');

    }
}
