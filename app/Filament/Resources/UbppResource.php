<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UbppResource\Pages;
use App\Filament\Resources\UbppResource\RelationManagers;
use App\Models\Ubpp;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class UbppResource extends Resource
{
    protected static ?string $model = Ubpp::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationGroup = 'Catálogos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
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
                    Forms\Components\TextInput::make('director')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('extension')
                        ->label('Teléfono o Extensión')
                        ->maxLength(255),
                ])
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ubpp')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('director')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('extension')
                    ->label('Extensión')
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
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUbpps::route('/'),
        ];
    }    
}
