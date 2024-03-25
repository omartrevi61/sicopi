<?php

namespace App\Filament\Resources\ProvedorResource\Pages;

use App\Filament\Resources\ProvedorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProvedor extends EditRecord
{
    protected static string $resource = ProvedorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
