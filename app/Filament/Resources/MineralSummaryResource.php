<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MineralSummaryResource\Pages;
use App\Models\MineralSummary;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class MineralSummaryResource extends Resource
{
    protected static ?string $model = MineralSummary::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    
    protected static ?string $navigationGroup = 'Control de minerales';

    protected static ?int $navigationSort = 1;
    
    protected static ?string $navigationLabel = 'Control de Minerales';
    
    protected static ?string $modelLabel = 'Resumen de Minerales';
    
    protected static ?string $pluralModelLabel = 'Resúmenes de Minerales';

    // Establecer el nombre de la ruta relativa para asegurar la generación correcta de rutas
    public static function getRelativeRouteName(): string
    {
        return 'mineral-summaries';
    }

    // Verificar si el usuario tiene permiso para ver este recurso
    public static function canAccess(): bool
    {
        // TODO: Implementar verificación de roles correctamente
        return Auth::check();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fecha')
                    ->date('d.M.Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('proyecto_codigo')
                    ->label('Código Proyecto')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('proyecto_nombre')
                    ->label('Nombre Proyecto')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('toneladas_mina')
                    ->label('Toneladas Mina')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('toneladas_trituradora')
                    ->label('Toneladas Trituradora')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('toneladas_puerto')
                    ->label('Toneladas Puerto')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                // Filtros para fecha y proyecto
                Tables\Filters\Filter::make('fecha')
                    ->form([
                        Forms\Components\DatePicker::make('desde'),
                        Forms\Components\DatePicker::make('hasta'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['desde'],
                                fn (Builder $query, $date): Builder => $query->whereDate('fecha', '>=', $date),
                            )
                            ->when(
                                $data['hasta'],
                                fn (Builder $query, $date): Builder => $query->whereDate('fecha', '<=', $date),
                            );
                    }),
                Tables\Filters\SelectFilter::make('proyecto_codigo')
                    ->label('Proyecto')
                    ->options(function (): array {
                        return \App\Models\Project::pluck('name', 'code')->toArray();
                    })
            ])
            ->actions([])
            ->bulkActions([])
            ->defaultSort('fecha', 'desc');
    }

    public static function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form
            ->schema([
                // Este es un recurso de solo lectura basado en una vista, por lo que no se definen campos editables
                \Filament\Forms\Components\Placeholder::make('aviso')
                    ->content('Este es un recurso de solo lectura basado en una vista de base de datos.')
                    ->columnSpanFull(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMineralSummaries::route('/'),
        ];
    }
}