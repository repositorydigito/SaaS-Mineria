<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyProductionTonResource\Pages;
use App\Models\DailyProductionTon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DailyProductionTonResource extends Resource
{
    protected static ?string $model = DailyProductionTon::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Producción';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detalles de Producción')
                    ->description('Información de la producción diaria')
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
                        Forms\Components\TextInput::make('dump_trucks')
                            ->label('Cantidad de Volquetes')
                            ->required()
                            ->numeric()
                            ->integer()
                            ->minValue(0),
                        Forms\Components\TextInput::make('tons')
                            ->label('Toneladas')
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
                Tables\Columns\TextColumn::make('date')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('dump_trucks')
                    ->label('Volquetes')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tons')
                    ->label('Toneladas')
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
            'index' => Pages\ListDailyProductionTons::route('/'),
            'create' => Pages\CreateDailyProductionTon::route('/create'),
            'edit' => Pages\EditDailyProductionTon::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Tonelada';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Toneladas';
    }
}
