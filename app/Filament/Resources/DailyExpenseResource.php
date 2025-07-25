<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyExpenseResource\Pages;
use App\Models\DailyExpense;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DailyExpenseResource extends Resource
{
    protected static ?string $model = DailyExpense::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Producción';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detalles del Gasto')
                    ->description('Información del gasto diario')
                    ->schema([
                        Forms\Components\Select::make('project_id')
                            ->relationship('project', 'name')
                            ->label('Proyecto')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\DatePicker::make('date')
                            ->label('Fecha')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y'),
                        Forms\Components\TextInput::make('total_amount')
                            ->label('Monto Total')
                            ->required()
                            ->numeric()
                            ->prefix('S/')
                            ->minValue(0)
                            ->step(0.01),
                        Forms\Components\Textarea::make('details')
                            ->label('Detalles')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpanFull()
                            ->helperText('Especifique todos los gastos realizados'),
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
                Tables\Columns\TextColumn::make('date')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Monto Total')
                    ->prefix('S/')
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
            'index' => Pages\ListDailyExpenses::route('/'),
            'create' => Pages\CreateDailyExpense::route('/create'),
            'edit' => Pages\EditDailyExpense::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Gasto Varios';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Gastos Varios';
    }
}
