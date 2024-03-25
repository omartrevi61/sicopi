<?php

namespace App\Filament\Profesor\Resources\ProyectoResource\Pages;

use App\Filament\Profesor\Resources\ProyectoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProyectos extends ListRecords
{
    protected static string $resource = ProyectoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
