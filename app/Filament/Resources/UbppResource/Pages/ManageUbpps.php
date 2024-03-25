<?php

namespace App\Filament\Resources\UbppResource\Pages;

use App\Filament\Resources\UbppResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageUbpps extends ManageRecords
{
    protected static string $resource = UbppResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
