<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyDrillingProgressResource\Pages;
use App\Models\DailyDrillingProgress;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DailyDrillingProgressResource extends Resource
{
    protected static ?string $model = DailyDrillingProgress::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-up';
    protected static ?string $navigationGroup = 'Producción';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detalles del Avance')
                    ->description('Información del avance de perforación')
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
                        Forms\Components\TextInput::make('drills_count')
                            ->label('Cantidad de Taladros')
                            ->required()
                            ->numeric()
                            ->integer()
                            ->minValue(0)
                            ->live()
                            ->afterStateUpdated(function ($state, $get, $set) {
                                if ($state && $get('meters_per_drill')) {
                                    $total = $state * $get('meters_per_drill');
                                    $set('total_meters', number_format($total, 2));
                                }
                            }),
                        Forms\Components\TextInput::make('meters_per_drill')
                            ->label('Metros por Taladro')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->step(0.01)
                            ->live()
                            ->afterStateUpdated(function ($state, $get, $set) {
                                if ($state && $get('drills_count')) {
                                    $total = $state * $get('drills_count');
                                    $set('total_meters', number_format($total, 2));
                                }
                            }),
                        Forms\Components\TextInput::make('total_meters')
                            ->label('Total de Metros')
                            ->disabled()
                            ->dehydrated(false)
                            ->numeric()
                            ->helperText('Este valor se calcula automáticamente')
                            ->rules([
                                'numeric',
                                function ($attribute, $value, $fail) {
                                    if (preg_match('/^\d+(\.\d{1,2})?$/', $value) !== 1) {
                                        $fail("El campo {$attribute} debe tener máximo 2 decimales.");
                                    }
                                },
                            ]),
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
                Tables\Columns\TextColumn::make('drills_count')
                    ->label('Taladros')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('meters_per_drill')
                    ->label('Metros/Taladro')
                    ->numeric(2)
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_meters')
                    ->label('Total Metros')
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
            'index' => Pages\ListDailyDrillingProgresses::route('/'),
            'create' => Pages\CreateDailyDrillingProgress::route('/create'),
            'edit' => Pages\EditDailyDrillingProgress::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Avance';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Avances';
    }
}
