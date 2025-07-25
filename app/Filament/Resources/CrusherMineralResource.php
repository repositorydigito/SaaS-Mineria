<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CrusherMineralResource\Pages;
use App\Filament\Resources\CrusherMineralResource\RelationManagers;
use App\Models\CrusherMineral;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CrusherMineralResource extends Resource
{
    protected static ?string $model = CrusherMineral::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    
    protected static ?string $navigationGroup = 'Control de minerales';
    
    protected static ?int $navigationSort = 3;
    
    protected static ?string $modelLabel = 'Mineral de Trituradora';
    
    protected static ?string $pluralModelLabel = 'Minerales de Trituradora';

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
            'index' => Pages\ListCrusherMinerals::route('/'),
            'create' => Pages\CreateCrusherMineral::route('/create'),
            'edit' => Pages\EditCrusherMineral::route('/{record}/edit'),
        ];
    }
    
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
    
    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        
        return $data;
    }
}
