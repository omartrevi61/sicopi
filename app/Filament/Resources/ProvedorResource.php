<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProvedorResource\Pages;
use App\Filament\Resources\ProvedorResource\RelationManagers;
use App\Models\Provedor;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;

use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ProvedorResource extends Resource
{
    protected static ?string $model = Provedor::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationLabel = 'Proveedores';
    protected static ?string $navigationGroup = 'Contra-Recibos';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                    Grid::make()
                        ->schema([
                            Forms\Components\TextInput::make('rfc')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->maxLength(13),
                        ]),

                        Forms\Components\TextInput::make('nombre')
                            ->label('Nombre o Razón Social')
                            ->columnSpan('full')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('telefono')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('clabe')
                            ->label('Clabe Interbancaria')
                            ->maxLength(18),
                        Forms\Components\TextInput::make('banco')
                            ->maxLength(50),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('rfc')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefono')
                    ->label('Teléfono'),
                Tables\Columns\TextColumn::make('banco')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('clabe')
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
                        if ($record->documentos()->count() > 0) {
                            Notification::make()
                                ->danger()
                                ->title('No se puede eliminar ese Proveedor')
                                ->body('EL PROVEEDOR TIENE CONTRA-RECIBOS')
                                ->send();

                            return;
                        }

                        $record->delete();

                        Notification::make()
                                ->success()
                                ->title('Proveedor eliminado')
                                ->body('Proveedor eliminado correctamente')
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
            'index' => Pages\ListProvedors::route('/'),
            'create' => Pages\CreateProvedor::route('/create'),
            'edit' => Pages\EditProvedor::route('/{record}/edit'),
        ];
    }    
}
