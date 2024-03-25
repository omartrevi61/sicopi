<?php

namespace App\Filament\Profesor\Resources;

use App\Filament\Profesor\Resources\ReciboResource\Pages;
use App\Filament\Profesor\Resources\ReciboResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\Summarizers\Sum;

use App\Models\Proyecto;
use App\Models\Recibo;

class ReciboResource extends Resource
{
    protected static ?string $model = Recibo::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'ContraRecibos';

    // obtengo solo los contraRecibos de los proyectos del profesor logueado
    public static function getEloquentQuery(): Builder
    {        
        $profesorId = auth()->user()->profesor_id;

        $recibos = Recibo::join('proyectos', 'proyectos.id', 'recibos.proyecto_id')
                    ->where('proyectos.profesor_id', $profesorId);
        
        return $recibos;
    } 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Folio')
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('proyecto.proyecto')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('beneficiario')
                    ->sortable()
                    ->searchable(),

                // obtengo la suma del importe de los documentos 
                Tables\Columns\TextColumn::make('documentos_sum_importe')->sum('documentos', 'importe')
                ->label('Total')
                ->numeric(
                    decimalPlaces: 2,
                    decimalSeparator: '.',
                    thousandsSeparator: ',',
                )
                ->summarize(Sum::make()->numeric(
                    decimalPlaces: 2,
                    decimalSeparator: '.',
                    thousandsSeparator: ',',
                ))
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Action::make('Imprimir')
                    ->icon('heroicon-o-printer')
                    ->url(fn(Recibo $record) => route('recibo.pdf', $record))
                    ->openUrlInNewTab()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecibos::route('/'),
            'create' => Pages\CreateRecibo::route('/create'),
            'edit' => Pages\EditRecibo::route('/{record}/edit'),
        ];
    }    
}
