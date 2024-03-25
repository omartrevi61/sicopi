<?php

namespace App\Filament\Profesor\Resources;

use App\Filament\Profesor\Resources\ProyectoResource\Pages;
use App\Filament\Profesor\Resources\ProyectoResource\RelationManagers;
use App\Models\Proyecto;
use App\Models\Recibo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Grid;
use Filament\Infolists\Components\Section as ComponentsSection;
use Filament\Tables\Columns\TextColumn;

use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\Summarizers\Sum;

Use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProyectoResource extends Resource
{
    protected static ?string $model = Proyecto::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    // obtengo solo los proyectos de profesor logueado
    public static function getEloquentQuery(): Builder
    {        
        $profesorId = auth()->user()->profesor_id;
        $proyectos = Proyecto::where('profesor_id', $profesorId);

        return $proyectos;
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
                Tables\Columns\TextColumn::make('proyecto')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('titulo')
                    ->wrap()
                    ->sortable()              
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('profesor.nombre_completo')
                    ->label('Responsable')
                    ->limit(30)
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('aprobado')
                    ->sortable()
                    // ->money('MXN'),
                    ->getStateUsing(function (Proyecto $record): string {
                        return number_format($record->aprobado, 2);
                    })
                    ->summarize(Sum::make()->numeric(
                        decimalPlaces: 2,
                        decimalSeparator: '.',
                        thousandsSeparator: ',',
                    )),

                Tables\Columns\TextColumn::make('porcentaje')
                    ->label('% Asignado'),

                // forma de obtener una columna calculada
                Tables\Columns\TextColumn::make('asignado')
                    ->getStateUsing(function (Proyecto $record): string {
                        return number_format($record->aprobado * $record->porcentaje / 100, 2);
                    })
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
                    ->url(fn(Proyecto $record) => route('proyecto.pdf', $record))
                    ->openUrlInNewTab()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
/*                     Tables\Actions\DeleteBulkAction::make(),
 */                ]),
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
            'index' => Pages\ListProyectos::route('/'),
            'create' => Pages\CreateProyecto::route('/create'),
            'edit' => Pages\EditProyecto::route('/{record}/edit'),
        ];
    }    
}
