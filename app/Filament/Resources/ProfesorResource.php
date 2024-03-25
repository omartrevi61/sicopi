<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfesorResource\Pages;
use App\Filament\Resources\ProfesorResource\RelationManagers;
use App\Models\Profesor;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;

use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ProfesorResource extends Resource
{
    protected static ?string $model = Profesor::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Profesores';

    protected static ?string $navigationGroup = 'Proyectos';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                    Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('expediente')
                            ->required()
                            ->numeric()
                            ->unique(ignoreRecord: true)
                            ->maxLength(6),
                        ]),
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
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('telefono')
                            ->label('Teléfono')
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('expediente')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('nombre')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('apellidos')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('email')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('telefono')
                ->label('Teléfono'),
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
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListProfesors::route('/'),
            'create' => Pages\CreateProfesor::route('/create'),
            'edit' => Pages\EditProfesor::route('/{record}/edit'),
        ];
    }    

   
}
