<?php

namespace App\Exports;

use App\Models\Recibo;
use App\Models\ReciboItems;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use Illuminate\Support\Facades\DB;

class RecibosExport implements FromCollection, WithHeadings, WithCustomStartCell, WithTitle, WithStyles
{
    protected $tipoReporte, $cual;

    function __construct($tipoReporte, $cual)
    {
        $this->tipoReporte = $tipoReporte;
        $this->cual = $cual;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        switch ($this->tipoReporte) {
            case 0:  // Relación de ContraRecibos
                if($this->cual == 0){  // todos los contraRecibos del 1 al n

                    $recibos = Recibo::join('proyectos', 'proyectos.id', 'recibos.proyecto_id')
                    ->join('profesors', 'profesors.id', 'proyectos.profesor_id')
                    ->join('tipo_pagos as tp', 'tp.id', 'recibos.tipo_pago_id')
                    ->join('recibo_items', 'recibo_items.recibo_id', 'recibos.id')
                    ->select('recibos.id', 'recibos.fecha', 'recibos.beneficiario', 'tp.nombre', 'proyectos.proyecto', 
                        'profesors.nombre_completo', DB::raw('sum(recibo_items.importe)'))
                    ->orderBy('recibos.id')
                    ->groupBy('recibos.id')

                    ->get();

                    // dd($proyectos);

                }else{
                    // ContraRecibos de un solo proyecto
                    $recibos = Recibo::join('proyectos', 'proyectos.id', 'recibos.proyecto_id')
                    ->where('proyectos.id', $this->cual)
                    ->join('profesors', 'profesors.id', 'proyectos.profesor_id')
                    ->join('tipo_pagos as tp', 'tp.id', 'recibos.tipo_pago_id')
                    ->join('recibo_items', 'recibo_items.recibo_id', 'recibos.id')
                    ->select('recibos.id', 'recibos.fecha', 'recibos.beneficiario', 'tp.nombre', 'proyectos.proyecto', 
                        'profesors.nombre_completo', DB::raw('sum(recibo_items.importe)'))
                    ->orderBy('recibos.id')
                    ->groupBy('recibos.id')
                    ->get();
                }
                    
                break;

            case 1:  // ContraRecibos a nivel documento
                if($this->cual == 0){  // todos los contraRecibos del 1 al n

                    $recibos = ReciboItems::join('recibos', 'recibos.id', 'recibo_items.recibo_id')
                        ->join('proyectos', 'proyectos.id', 'recibos.proyecto_id')
                        ->join('provedors', 'provedors.id', 'recibo_items.provedor_id')
                        ->orderBy('recibo_id')
                        ->select('recibo_items.recibo_id', 'recibos.fecha', 'proyectos.proyecto', 'recibo_items.factura',
                            'provedors.nombre', 'recibo_items.concepto', 'recibo_items.importe')
                        ->get();

                    // dd($proyectos);

                }else{
                    // ContraRecibos a nivel detalle de un solo proyecto
                    $recibos = ReciboItems::join('recibos', 'recibos.id', 'recibo_items.recibo_id')
                        ->join('proyectos', 'proyectos.id', 'recibos.proyecto_id')
                        ->join('provedors', 'provedors.id', 'recibo_items.provedor_id')
                        ->where('proyectos.id', $this->cual)
                        ->orderBy('recibo_id')
                        ->select('recibo_items.recibo_id', 'recibos.fecha', 'proyectos.proyecto', 'recibo_items.factura',
                            'provedors.nombre', 'recibo_items.concepto', 'recibo_items.importe')
                        ->get();
                }
                    
                break;

        }

        return $recibos;
    }

    public function headings(): array
    {
        switch ($this->tipoReporte) {
            case 0:  // por Tipo de Proyecto
                return ['Folio CR', 'Fecha', 'Beneficiario', 'Tipo Pago', 'Proyecto', 'Responsable', 'Total'];
            case 1:  // ContraRecibos a Nivel Documento
                return ['Folio CR', 'Fecha_CR', 'Proyecto', 'Factura', 'Proveedor', 'Concepto', 'Importe'];
            }
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            2 => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
    {
        return 'Contra Recibos'; 
    }

}
