<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

use App\Models\Proyecto;

class rptContraRecibos extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-printer';

    protected static string $view = 'filament.pages.rpt-contra-recibos';

    protected static ?string $navigationGroup = 'Contra-Recibos';
    protected static ?string $navigationLabel = 'Reportes';
    protected static ?int $navigationSort = 3;

    protected static ?string $title = 'Reportes de Contra-Recibos';

    public $tipoReporte, $cual;
    public $proyectos;

    public function mount() {
        
        $this->tipoReporte = 0;
        $this->cual = 0;

        $this->proyectos = Proyecto::select('id', 'proyecto')->orderBy('proyecto')->get();
    }

}
