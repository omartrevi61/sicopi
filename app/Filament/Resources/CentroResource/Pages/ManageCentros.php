<?php

namespace App\Filament\Resources\CentroResource\Pages;

use App\Filament\Resources\CentroResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCentros extends ManageRecords
{
    protected static string $resource = CentroResource::class;

    protected static ?string $title = 'Centros de Investigación';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
