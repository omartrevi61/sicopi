<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipoProyectoResource\Pages;
use App\Filament\Resources\TipoProyectoResource\RelationManagers;
use App\Models\TipoProyecto;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;

use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class TipoProyectoResource extends Resource
{
    protected static ?string $model = TipoProyecto::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Tipos de Proyecto';

    protected static ?string $navigationGroup = 'Proyectos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                    Forms\Components\TextInput::make('nombre')
                        ->label('Tipo de Proyecto')
                        ->columnSpan('full')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),
                ])
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre')
                    ->label('Tipo de proyecto')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                
                Tables\Actions\DeleteAction::make()
                    ->action(function ($data, $record) {
                        if ($record->proyectos()->count() > 0) {
                            Notification::make()
                                ->danger()
                                ->title('No se puede eliminar ese Tipo de Proyecto')
                                ->body('EXISTEN PROYECTOS CON ESE TIPO')
                                ->send();

                            return;
                        }

                        $record->delete();

                        Notification::make()
                                ->success()
                                ->title('Tipo de Proyecto eliminado')
                                ->body('Tipo de Proyecto eliminado correctamente')
                                ->send();
                    })
            ])
            ->bulkActions([                
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make(),
                ]),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTipoProyectos::route('/'),
        ];
    }    
}
