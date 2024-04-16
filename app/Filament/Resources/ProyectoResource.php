<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProyectoResource\Pages;
use App\Filament\Resources\ProyectoResource\RelationManagers;
use App\Models\Proyecto;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Notifications\Notification;

use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ProyectoResource extends Resource
{
    protected static ?string $model = Proyecto::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $navigationGroup = 'Proyectos';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                    Forms\Components\TextInput::make('proyecto')
                        ->label('Clave del Proyecto')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(30),
                    Forms\Components\Select::make('tipo_proyecto_id')
                        ->label('Tipo de Proyecto')
                        ->required()
                        ->relationship('tipo_proyecto', 'nombre')
                        ->createOptionForm([
                            Forms\Components\TextInput::make('nombre')
                            ->label('Tipo de Proyecto')
                            ->columnSpan('full')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        ]),
                    Forms\Components\Textarea::make('titulo')
                        ->label('Título del Proyecto')
                        ->columnSpan('full')
                        ->rows(3)
                        ->required()
                        ->maxLength(255),
                    
                    Forms\Components\Select::make('profesor_id')
                        ->label('Responsable del Proyecto')
                        ->required()
                        ->relationship('profesor', 'nombre_completo') // nombre_completo es una columna virtual definida en la migración
                        ->createOptionForm([
                            Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('expediente')
                                    ->required()
                                    ->numeric()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(6),
                            
                                Forms\Components\TextInput::make('nombre')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('apellidos')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('grado')
                                    ->label('Grado Académico')
                                    ->required()
                                    ->maxLength(10),
                                Forms\Components\Select::make('ubpp_id')
                                    ->label('Departamento')
                                    ->required()
                                    ->relationship('ubpp', 'nombre')
                            ])->columns(2),
                        ]),   
                         
                    Forms\Components\Select::make('centro_id')
                        ->label('Centro de Investigación')
                        ->required()
                        ->relationship('centro', 'nombre')
                        ->createOptionForm([
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
                        ]),
                
                    Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('aprobado')
                            ->label('Presupuesto Total Aprobado')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $get, callable $set){
                                $porcentaje = $get('porcentaje');
                                $set('asignado', number_format(($state * $porcentaje / 100), 2)); 
                            }),
                        Forms\Components\TextInput::make('porcentaje')
                            ->label('Porcentaje Asignado')
                            ->required()
                            ->numeric()
                            ->default(100)
                            ->minValue(1)
                            ->maxValue(100)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $get, callable $set){
                                $aprobado = $get('aprobado');
                                $set('asignado', number_format(($state * $aprobado / 100), 2)); 
                            }),
                        Forms\Components\TextInput::make('asignado')
                            ->disabled()
                            ->dehydrated(false)  // no salvarse en la Base de datos
                    ])->columns(3),
                ])->columns(2)
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

                Tables\Columns\TextColumn::make('profesor.nombre_completo')
                    ->label('Responsable')
                    ->sortable()
                    ->searchable()
                    ->limit(25)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                
                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }
                
                        // Only render the tooltip if the column content exceeds the length limit.
                        return $state;
                    }), 

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
                    )),
                ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                Tables\Actions\DeleteAction::make()
                    ->action(function ($data, $record) {
                        if ($record->recibos()->count() > 0) {
                            Notification::make()
                                ->danger()
                                ->title('No se puede eliminar ese Proyecto')
                                ->body('EL PROYECTO TIENE CONTRA-RECIBOS')
                                ->send();

                            return;
                        }

                        $record->delete();

                        Notification::make()
                                ->success()
                                ->title('Proyecto eliminado')
                                ->body('Proyecto eliminado correctamente')
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
