<?php

namespace App\Filament\Profesor\Resources\ReciboResource\Pages;

use App\Filament\Profesor\Resources\ReciboResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRecibo extends EditRecord
{
    protected static string $resource = ReciboResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
