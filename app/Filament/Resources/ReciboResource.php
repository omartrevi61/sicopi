<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReciboResource\Pages;
use App\Filament\Resources\ReciboResource\RelationManagers;
use App\Models\Recibo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Tables\Actions\Action;
use Illuminate\Notifications\Notification;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ReciboResource extends Resource
{
    protected static ?string $model = Recibo::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'ContraRecibos';
    protected static ?string $navigationGroup = 'Contra-Recibos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Select::make('proyecto_id')
                            ->label('Proyecto')
                            ->required()
                            ->relationship('proyecto', 'proyecto'),
                        Forms\Components\DatePicker::make('fecha')
                            ->label('Fecha del Contra-Recibo')
                            ->default(now())
                            ->required(),
                        Forms\Components\Select::make('tipo_pago_id')
                            ->label('Tipo de Pago')
                            ->required()
                            ->relationship('tipo_pago', 'nombre')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('nombre')
                                    ->label('Tipo de Pago')
                                    ->columnSpan('full')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                            ]),
                        Forms\Components\TextInput::make('beneficiario')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Placeholder::make('total')
                            ->label("Total Contra-Recibo")
                            ->content(function ($get) {
                                $total = collect($get('documentos'))
                                    ->pluck('importe')
                                    ->sum();
                                return number_format($total, 2);
                            }),
                    ])->columns(2),

                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Repeater::make('documentos')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('factura')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                                Forms\Components\DatePicker::make('fecha_factura')
                                    ->label('Fecha Factura')
                                    ->default(now())
                                    ->required(),
                                Forms\Components\Select::make('provedor_id')
                                    ->label('Proveedor')
                                    ->required()
                                    ->relationship('provedor', 'nombre')
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('rfc')
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->maxLength(13),
                                        Forms\Components\TextInput::make('nombre')
                                            ->label('Nombre o Razón Social')
                                            ->columnSpan('full')
                                            ->required()
                                            ->maxLength(255),
                                    ]),
                                Forms\Components\TextInput::make('concepto')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpan(2),
                                Forms\Components\TextInput::make('importe')
                                    ->label('Importe')
                                    ->required()
                                    ->numeric()
                                    ->reactive(),
                        ])->columns(3)->addActionLabel('Agregar Documento'),             
                    ])
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
                Tables\Columns\TextColumn::make('tipo_pago.nombre')
                    ->sortable()
                    ->searchable(),
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
                ),
                
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Capturó')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                Action::make('Imprimir')
                    ->icon('heroicon-o-printer')
                    ->url(fn(Recibo $record) => route('recibo.pdf', $record))
                    ->openUrlInNewTab(),

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
            'index' => Pages\ListRecibos::route('/'),
            'create' => Pages\CreateRecibo::route('/create'),
            'edit' => Pages\EditRecibo::route('/{record}/edit'),
        ];
    }    
}
