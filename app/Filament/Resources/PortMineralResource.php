<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortMineralResource\Pages;
use App\Filament\Resources\PortMineralResource\RelationManagers;
use App\Models\PortMineral;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PortMineralResource extends Resource
{
    protected static ?string $model = PortMineral::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    
    protected static ?string $navigationGroup = 'Control de minerales';
    
    protected static ?int $navigationSort = 4;
    
    protected static ?string $modelLabel = 'Mineral de Puerto';
    
    protected static ?string $pluralModelLabel = 'Minerales de Puerto';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('project_id')
                    ->relationship('project', 'name')
                    ->required()
                    ->label('Proyecto'),
                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->label('Fecha'),
                Forms\Components\TextInput::make('tons')
                    ->required()
                    ->numeric()
                    ->label('Toneladas'),
                Forms\Components\Textarea::make('details')
                    ->columnSpanFull()
                    ->label('Detalles'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project.name')
                    ->numeric()
                    ->sortable()
                    ->label('Proyecto'),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable()
                    ->label('Fecha'),
                Tables\Columns\TextColumn::make('tons')
                    ->numeric()
                    ->sortable()
                    ->label('Toneladas'),
          
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Fecha de creación'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Fecha de actualización'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Editar'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Eliminar seleccionados'),
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
            'index' => Pages\ListPortMinerals::route('/'),
            'create' => Pages\CreatePortMineral::route('/create'),
            'edit' => Pages\EditPortMineral::route('/{record}/edit'),
        ];
    }
}
