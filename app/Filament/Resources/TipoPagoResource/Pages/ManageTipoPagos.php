<?php

namespace App\Filament\Resources\TipoPagoResource\Pages;

use App\Filament\Resources\TipoPagoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTipoPagos extends ManageRecords
{
    protected static string $resource = TipoPagoResource::class;

    protected static ?string $title = 'Tipos de Pago';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
