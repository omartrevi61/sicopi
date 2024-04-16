<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CentroResource\Pages;
use App\Filament\Resources\CentroResource\RelationManagers;
use App\Models\Centro;
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

use Filament\Tables\Columns\TextColumn;

class CentroResource extends Resource
{
    protected static ?string $model = Centro::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Catálogos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                    Forms\Components\TextInput::make('centro')
                        ->label('Número de Centro')
                        ->required()
                        ->numeric()
                        ->unique(ignoreRecord: true)
                        ->maxLength(4),
                    Forms\Components\TextInput::make('nombre')
                        ->label('Nombre del Centro')
                        ->columnSpan('full')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('coordinador')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Select::make('ubpp_id')
                        ->label('Departamento')
                        ->required()
                        ->relationship('ubpp', 'nombre')
                        ->createOptionForm([
                            Forms\Components\TextInput::make('ubpp')
                                ->label('Número de Ubpp')
                                ->required()
                                ->numeric()
                                ->unique(ignoreRecord: true)
                                ->maxLength(2),

                            Forms\Components\TextInput::make('nombre')
                                ->label('Nombre de la Ubpp')
                                ->columnSpan('full')
                                ->required()
                                ->maxLength(255),
                        ]),
                    Forms\Components\TextInput::make('proy_ptal')
                        ->label('Proyecto Presupuestal')
                        ->required()
                        ->numeric()
                        ->maxLength(4),
                ])->columns(2)
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('centro')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre')
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                 
                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }
                 
                        // Only render the tooltip if the column content exceeds the length limit.
                        return $state;
                    })
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('coordinador')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('proy_ptal')
                    ->label('Ptal')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('ubpp.nombre')
                    ->label('Departamento')
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
                                ->title('No se puede eliminar ese Centro')
                                ->body('EL CENTRO TIENE PROYECTOS')
                                ->send();

                            return;
                        }

                        $record->delete();

                        Notification::make()
                                ->success()
                                ->title('Centro eliminado')
                                ->body('Centro eliminado correctamente')
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
            'index' => Pages\ManageCentros::route('/'),
        ];
    }    
}
