<?php

namespace App\Filament\Resources\AdministrativoResource\Pages;

use App\Filament\Resources\AdministrativoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAdministrativos extends ManageRecords
{
    protected static string $resource = AdministrativoResource::class;

    protected static ?string $title = 'Jefe Dgip';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
