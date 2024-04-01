<?php

namespace App\Http\Controllers;

use App\Exports\EdoPtalExport;
use App\Exports\RecibosExport;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Proyecto;
use App\Models\Recibo;
use App\Models\ReciboItems;

class ReportController extends Controller
{
    //****  Estado Presupuestal de Proyectos  */
    public function rptEdoPtal($tipoReporte, $cual)  {

        switch ($tipoReporte) {
            case 0:  // por Tipo de Proyecto
                if($cual == 0){
                    $proyectos = Proyecto::orderBy('tipo_proyecto_id')
                                ->orderBy('proyecto')
                                ->withSum('documentos', 'importe')
                                ->get();
                }else{
                    $proyectos = Proyecto::where('tipo_proyecto_id', $cual)
                                ->orderBy('tipo_proyecto_id')
                                ->orderBy('proyecto')
                                ->withSum('documentos', 'importe')
                                ->get();
                }
                    
                $pdf = Pdf::loadView('reportes.rptEdoPtal', compact('proyectos'))->setPaper('a4', 'landscape');

                break;
            
            case 1:  // por Responsable de Proyecto
                if($cual == 0){
                    $proyectos = Proyecto::withAggregate('profesor','nombre')  // clasifica por nombre del responsable
                                ->orderBy('profesor_nombre')
                                ->withSum('documentos', 'importe')
                                ->get();
                }else{

                    $proyectos = Proyecto::where('profesor_id', $cual)
                                ->withAggregate('profesor','nombre')
                                ->orderBy('profesor_nombre')
                                ->withSum('documentos', 'importe')
                                ->get();
                }

                $pdf = Pdf::loadView('reportes.rptEdoPtalResponsa', compact('proyectos'))->setPaper('a4', 'landscape');

                break;

            case 2:   // por Centro o Instituo de investigación
                if($cual == 0){
                    $proyectos = Proyecto::withAggregate('centro','nombre')  // clasifica por nombre de centro
                                ->orderBy('centro_nombre')
                                ->withSum('documentos', 'importe')
                                ->get();
                }else{

                    $proyectos = Proyecto::where('centro_id', $cual)
                                ->withAggregate('centro','nombre')
                                ->orderBy('centro_nombre')
                                ->withSum('documentos', 'importe')
                                ->get();

                }

                $pdf = Pdf::loadView('reportes.rptEdoPtalCentro', compact('proyectos'))->setPaper('a4', 'landscape');

                break;
        }

        return $pdf->stream('proyectos.pdf');
    }

    // **** Estado Presupuestal a Excel
    public function EdoPtalExcel($tipoReporte, $cual)
    {
        $reportName = '';

        switch ($tipoReporte) {
            case 0:  // por Tipo de Proyecto
                $reportName = 'EdoPtal_porTipo' . uniqid() . '.xlsx';
            case 1:  // por Responsable de Proyecto
                $reportName = 'EdoPtal_porResponsable' . uniqid() . '.xlsx';
            case 2:   // por Centro o Instituo de investigación
                $reportName = 'EdoPtal_porCentro' . uniqid() . '.xlsx';
            }
        
        return Excel::download(new EdoPtalExport($tipoReporte, $cual), $reportName);
    }

     
    //*****  Reportes de ContraRecibos  */
    public function rptRecibos($tipoReporte, $cual)  {

        switch ($tipoReporte) {
            case 0:  // Relación de ContraRecibos
                if($cual == 0){  // todos los contrarecibos del 1 al n
                    $recibos = Recibo::orderBy('id')
                            ->withSum('documentos', 'importe')
                            ->get();
                }else{
                    // ContraRecibos de un solo proyecto
                    $recibos = Recibo::where('proyecto_id', $cual)
                                ->orderBy('id')
                                ->withSum('documentos', 'importe')
                                ->get();
                }
                    
                $pdf = Pdf::loadView('reportes.rptContraRecibos', compact('recibos'))->setPaper('a4', 'landscape');

                break;
            
            case 1:  // Contrarecibos a nivel detalle (documentos)
                if($cual == 0){  // todos los contrarecibos del 1 al n
                    $recibos = Recibo::with('documentos')
                        ->orderBy('id')
                        ->withSum('documentos', 'importe')
                        ->get();
                }else{
                    // ContraRecibos de un solo proyecto
                    $recibos = Recibo::with('documentos')
                        ->where('proyecto_id', $cual)
                        ->orderBy('proyecto_id')
                        ->withSum('documentos', 'importe')
                        ->get();

                }

                $pdf = Pdf::loadView('reportes.rptContraRecibosDetalle', compact('recibos'))->setPaper('a4', 'landscape');

                break;

            case 2:   // por Centro o Instituo de investigación
                if($cual == 0){
                    $proyectos = Proyecto::withAggregate('centro','nombre')  // clasifica por nombre de centro
                                ->orderBy('centro_nombre')
                                ->get();
                }else{

                    $proyectos = Proyecto::where('centro_id', $cual)
                                ->withAggregate('centro','nombre')
                                ->orderBy('centro_nombre')
                                ->get();

                }

                $pdf = Pdf::loadView('reportes.rptProyCentro', compact('proyectos'))->setPaper('a4', 'landscape');

                break;
        }

        return $pdf->stream('proyectos.pdf');

    }


    // **** ContraRecibos a Excel
    public function RecibosExcel($tipoReporte, $cual)
    {
        $reportName = '';

        switch ($tipoReporte) {
            case 0:  // relación de ContraRecibos
                $reportName = 'RecibosExcel' . uniqid() . '.xlsx';
            case 1:  // ContraRecibos a nivel documento
                $reportName = 'RecibosExcel' . uniqid() . '.xlsx';
 
            }
        
        return Excel::download(new RecibosExport($tipoReporte, $cual), $reportName);
    }
}
