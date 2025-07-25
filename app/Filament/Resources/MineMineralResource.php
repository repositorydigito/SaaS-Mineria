<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MineMineralResource\Pages;
use App\Filament\Resources\MineMineralResource\RelationManagers;
use App\Models\MineMineral;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MineMineralResource extends Resource
{
    protected static ?string $model = MineMineral::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationGroup = 'Control de minerales';

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Mineral de Mina';

    protected static ?string $pluralModelLabel = 'Minerales de Mina';

    public static function form(Form $form): Form
    {
        $user = auth()->user();
        $userProject = $user->projects()->first();

        return $form
            ->schema([
                Forms\Components\Select::make('project_id')
                    ->relationship('project', 'name')
                    ->required()
                    ->label('Proyecto')
                    ->default($userProject?->id)
                    ->disabled()
                    ->helperText('Proyecto asignado al usuario'),
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
        $user = auth()->user();
        $userProject = $user->projects()->first();

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
            ])
            ->modifyQueryUsing(function (Builder $query) use ($userProject) {
                if ($userProject) {
                    $query->where('project_id', $userProject->id);
                }
            });
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
            'index' => Pages\ListMineMinerals::route('/'),
            'create' => Pages\CreateMineMineral::route('/create'),
            'edit' => Pages\EditMineMineral::route('/{record}/edit'),
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
