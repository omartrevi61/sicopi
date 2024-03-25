<?php

namespace App\Filament\Resources\ProfesorResource\Pages;

use App\Exports\ProfesorsExport;
use App\Filament\Resources\ProfesorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

use Filament\Actions\Action;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;

class ListProfesors extends ListRecords
{
    protected static string $resource = ProfesorResource::class;

    protected static ?string $title = 'Profesores';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            
/*             Action::make('Excel')
                ->label('Excel')
                ->size(ActionSize::Medium)
                ->color('success')
                ->url(route('profesors.excel'))
                ->openUrlInNewTab(), */

                // no tiene caso obtener el pdf, sale bien feo sin formato etc.
/*             Action::make('PDF')
                ->label('PDF')
                ->size(ActionSize::Medium)
                ->color('gray')
                ->url(route('profesors.pdf'))
                ->openUrlInNewTab(), */
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [
            BulkAction::make('export')
                ->action( fn (Collection $records) => new ProfesorsExport($records))
                ->deselectRecordsAfterCompletion()
        ];
    }
}
