<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HealthTypeResource\Pages;
use App\Models\HealthType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HealthTypeResource extends Resource
{
    protected static ?string $model = HealthType::class;
    protected static ?string $navigationIcon = 'heroicon-o-heart';
    protected static ?string $navigationGroup = 'Health';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->unique(ignoreRecord: true)
                    ->label('Health Type Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('unit')
                    ->label('Unit ( ex: kg, cm )')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('value_type')
                    ->label('Value Type')
                    ->options(['decimal' => 'Decimal', 'string' => 'String'])
                    ->required()
                    ->default('decimal'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Health Type Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('unit')
                    ->label('Unit')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('value_type')
                    ->label('Value Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'decimal' => 'success',
                        'string' => 'warning',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListHealthTypes::route('/'),
            'create' => Pages\CreateHealthType::route('/create'),
            'edit' => Pages\EditHealthType::route('/{record}/edit'),
        ];
    }
}
