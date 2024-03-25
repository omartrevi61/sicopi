<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Support\Enums\ActionSize;

use App\Models\TipoProyecto;
use App\Models\Profesor;
use App\Models\Centro;

class EstadoPresupuestal extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-printer';
    protected static ?string $navigationGroup = 'Proyectos';
    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.pages.estado-presupuestal';

    public $tipoReporte, $cual;
    public $proyectos, $tipos, $profesores, $centros;

    public function mount() {
        
        $this->tipoReporte = 0;
        $this->cual = 0;

        $this->tipos = TipoProyecto::orderBy('id')->get();
        $this->profesores = Profesor::orderBy('nombre_completo')->get();
        $this->centros = Centro::orderBy('nombre')->get();
    }

    // si coloca los dos botones pero no actualiza los parámetros 'tipoReporte' y 'cual'
    /* protected function getHeaderActions(): array
    {
        return [
            Action::make('Imprimir')
                ->label('Generar PDF')
                ->size(ActionSize::Large)
                ->url(route('rptEdoPtal', ['tipoReporte' => $this->tipoReporte, 'cual' => $this->cual]))
                ->openUrlInNewTab(),
            Action::make('Excel')
                ->label('Exportar a Excel')
                ->size(ActionSize::Large)
                ->url(route('EdoPtalExcel', [$this->tipoReporte, $this->cual]))
                ->openUrlInNewTab(),
        ];
    } */
    
    
}
