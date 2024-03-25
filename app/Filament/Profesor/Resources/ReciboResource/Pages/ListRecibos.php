<?php

namespace App\Filament\Profesor\Resources\ReciboResource\Pages;

use App\Filament\Profesor\Resources\ReciboResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRecibos extends ListRecords
{
    protected static string $resource = ReciboResource::class;

    protected static ?string $title = 'Contra-Recibos';

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
