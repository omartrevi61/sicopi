<?php

namespace App\Exports;

use App\Models\Proyecto;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\Summarizers\Sum;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

use Illuminate\Database\Query\JoinClause;

class EdoPtalExport implements FromCollection, WithHeadings, WithCustomStartCell, WithTitle, WithStyles
{
    protected $tipoReporte, $cual;

    function __construct($tipoReporte, $cual)
    {
        $this->tipoReporte = $tipoReporte;
        $this->cual = $cual;
    }

    public function collection()
    {
        switch ($this->tipoReporte) {
            case 0:  // por Tipo de Proyecto
                if($this->cual == 0){  // todos los proyectos

                    // forma de obtener el ejercido de cada proyecto,
                    // si no se usa leftJoin con Recibos los proyectos que no tengan movimientos no los saca
                    $proyectos = DB::table('proyectos')
                        ->join('profesors as profesor', 'profesor.id', 'proyectos.profesor_id')
                        ->join('tipo_proyectos as tp', 'tp.id', 'proyectos.tipo_proyecto_id')
                        ->leftJoin('recibos', 'recibos.proyecto_id', 'proyectos.id')
                        ->leftJoin('recibo_items', 'recibo_items.recibo_id', 'recibos.id')
                        ->select('tp.nombre as Tipo', 'proyectos.proyecto', 'proyectos.titulo', 'profesor.nombre_completo',
                                'proyectos.asignado', DB::raw('sum(recibo_items.importe)'))
                        ->orderBy('tp.nombre')
                        ->orderBy('proyectos.proyecto')
                        ->groupBy('proyectos.proyecto')
                        ->get();

                    // dd($proyectos);

                }else{
                    // un solo tipo de proyecto
                    $proyectos = DB::table('proyectos')
                        ->where('proyectos.tipo_proyecto_id', $this->cual)
                        ->join('profesors as profesor', 'profesor.id', 'proyectos.profesor_id')
                        ->join('tipo_proyectos as tp', 'tp.id', 'proyectos.tipo_proyecto_id')
                        ->leftJoin('recibos', 'recibos.proyecto_id', 'proyectos.id')
                        ->leftJoin('recibo_items', 'recibo_items.recibo_id', 'recibos.id')
                        ->select('tp.nombre as Tipo', 'proyectos.proyecto', 'proyectos.titulo', 'profesor.nombre_completo',
                                'proyectos.asignado', DB::raw('sum(recibo_items.importe)'))
                        ->orderBy('tp.nombre')
                        ->orderBy('proyectos.proyecto')
                        ->groupBy('proyectos.proyecto')
                        ->get();
                }
                    
                break;
            
            case 1:  // por Responsable de Proyecto
                if($this->cual == 0){  // todos los responsables de proyecto

                    $proyectos = DB::table('proyectos')
                        ->join('profesors as profesor', 'profesor.id', 'proyectos.profesor_id')
                        ->join('tipo_proyectos as tp', 'tp.id', 'proyectos.tipo_proyecto_id')
                        ->leftJoin('recibos', 'recibos.proyecto_id', 'proyectos.id')
                        ->leftJoin('recibo_items', 'recibo_items.recibo_id', 'recibos.id')
                        ->select('profesor.nombre_completo', 'proyectos.proyecto', 'proyectos.titulo', 'tp.nombre as Tipo',
                                'proyectos.asignado', DB::raw('sum(recibo_items.importe)'))
                        ->orderBy('profesor.nombre_completo')
                        ->orderBy('proyectos.proyecto')
                        ->groupBy('proyectos.proyecto')
                        ->get();

                }else{
                    // un solo responsable de proyecto
                    $proyectos = DB::table('proyectos')
                        ->where('proyectos.profesor_id', $this->cual)
                        ->join('profesors as profesor', 'profesor.id', 'proyectos.profesor_id')
                        ->join('tipo_proyectos as tp', 'tp.id', 'proyectos.tipo_proyecto_id')
                        ->leftJoin('recibos', 'recibos.proyecto_id', 'proyectos.id')
                        ->leftJoin('recibo_items', 'recibo_items.recibo_id', 'recibos.id')
                        ->select('profesor.nombre_completo', 'proyectos.proyecto', 'proyectos.titulo', 'tp.nombre as Tipo',
                                'proyectos.asignado', DB::raw('sum(recibo_items.importe)'))
                        ->orderBy('proyectos.proyecto')
                        ->groupBy('proyectos.proyecto')
                        ->get();
                }

                break;

            case 2:   // por Centro o Instituto de investigación
                if($this->cual == 0){  // todos los centros
                    $proyectos = DB::table('proyectos')
                        ->join('profesors as profesor', 'profesor.id', 'proyectos.profesor_id')
                        ->join('tipo_proyectos as tp', 'tp.id', 'proyectos.tipo_proyecto_id')
                        ->join('centros as centro', 'centro.id', 'proyectos.centro_id')
                        ->leftJoin('recibos', 'recibos.proyecto_id', 'proyectos.id')
                        ->leftJoin('recibo_items', 'recibo_items.recibo_id', 'recibos.id')
                        ->select('centro.nombre', 'proyectos.proyecto', 'proyectos.titulo', 'profesor.nombre_completo', 'tp.nombre as Tipo',
                                'proyectos.asignado', DB::raw('sum(recibo_items.importe)'))
                        ->orderBy('centro.nombre')
                        ->orderBy('proyectos.proyecto')
                        ->groupBy('proyectos.proyecto')
                        ->get();

                }else{
                    // un solo centro
                    $proyectos = DB::table('proyectos')
                        ->where('proyectos.centro_id', $this->cual)
                        ->join('profesors as profesor', 'profesor.id', 'proyectos.profesor_id')
                        ->join('tipo_proyectos as tp', 'tp.id', 'proyectos.tipo_proyecto_id')
                        ->join('centros as centro', 'centro.id', 'proyectos.centro_id')
                        ->leftJoin('recibos', 'recibos.proyecto_id', 'proyectos.id')
                        ->leftJoin('recibo_items', 'recibo_items.recibo_id', 'recibos.id')
                        ->select('centro.nombre', 'proyectos.proyecto', 'proyectos.titulo', 'profesor.nombre_completo', 'tp.nombre as Tipo',
                                'proyectos.asignado', DB::raw('sum(recibo_items.importe)'))
                        ->orderBy('centro.nombre')
                        ->orderBy('proyectos.proyecto')
                        ->groupBy('proyectos.proyecto')
                        ->get();
                }

                break;
        }

        return $proyectos;
    }

    public function headings(): array
    {
        switch ($this->tipoReporte) {
            case 0:  // por Tipo de Proyecto
                return ['Tipo de Proyecto', 'Proyecto', 'Titulo', 'Responsable', 'Asignado', 'Ejercido'];
            case 1:  // por Responsable de Proyecto
                return ['Responsable', 'Proyecto', 'Titulo', 'Tipo de Proyecto', 'Asignado', 'Ejercido'];
            case 2:   // por Centro o Instituo de investigación
                return ['Centro', 'Proyecto', 'Titulo', 'Responsable', 'Tipo de Proyecto', 'Asignado', 'Ejercido'];
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
        return 'Estado Presupuestal'; 
    }
}
