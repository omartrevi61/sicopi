<?php

namespace App\Filament\Resources\TipoProyectoResource\Pages;

use App\Filament\Resources\TipoProyectoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTipoProyectos extends ManageRecords
{
    protected static string $resource = TipoProyectoResource::class;

    protected static ?string $title = 'Tipos de Proyecto';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
