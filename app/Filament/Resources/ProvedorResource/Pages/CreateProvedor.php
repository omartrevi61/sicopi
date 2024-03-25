<?php

namespace App\Filament\Resources\ProvedorResource\Pages;

use App\Filament\Resources\ProvedorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProvedor extends CreateRecord
{
    protected static string $resource = ProvedorResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
