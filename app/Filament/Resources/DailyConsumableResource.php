<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyConsumableResource\Pages;
use App\Models\DailyConsumable;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DailyConsumableResource extends Resource
{
    protected static ?string $model = DailyConsumable::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube-transparent';
    protected static ?string $navigationGroup = 'Producción';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Registro de Consumible')
                    ->description('Información del consumo diario')
                    ->schema([
                        Forms\Components\Select::make('project_id')
                            ->relationship('project', 'name')
                            ->label('Proyecto')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('consumable_type_id')
                            ->relationship('consumableType', 'name')
                            ->label('Tipo de Consumible')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\DatePicker::make('date')
                            ->label('Fecha')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y'),
                        Forms\Components\TextInput::make('quantity')
                            ->label('Cantidad')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->step(0.01),
                        Forms\Components\Textarea::make('details')
                            ->label('Detalles')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project.name')
                    ->label('Proyecto')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('consumableType.name')
                    ->label('Tipo de Consumible')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Cantidad')
                    ->suffix(fn ($record) => ' ' . $record->consumableType->unit)
                    ->numeric(2)
                    ->sortable(),
                Tables\Columns\TextColumn::make('details')
                    ->label('Detalles')
                    ->limit(50),
                Tables\Columns\TextColumn::make('creator.name')
                    ->label('Creado por')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de Creación')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Última Actualización')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('project')
                    ->relationship('project', 'name')
                    ->label('Proyecto'),
                Tables\Filters\SelectFilter::make('consumable_type')
                    ->relationship('consumableType', 'name')
                    ->label('Tipo de Consumible'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDailyConsumables::route('/'),
            'create' => Pages\CreateDailyConsumable::route('/create'),
            'edit' => Pages\EditDailyConsumable::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Consumible';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Consumibles';
    }
}
