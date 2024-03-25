<?php

namespace App\Filament\Resources\ProvedorResource\Pages;

use App\Filament\Resources\ProvedorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProvedors extends ListRecords
{
    protected static string $resource = ProvedorResource::class;

    protected static ?string $title = 'Proveedores';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
