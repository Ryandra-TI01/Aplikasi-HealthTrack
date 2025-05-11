<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommunityGroupsResource\Pages;
use App\Filament\Resources\CommunityGroupsResource\RelationManagers;
use App\Models\CommunityGroup;
use App\Models\CommunityGroups;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommunityGroupsResource extends Resource
{
    protected static ?string $model = CommunityGroup::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'User and Community';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Group Name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                    Forms\Components\TextInput::make('group_link')
                    ->label('Group Link')
                    ->url()
                    ->suffixIcon('heroicon-m-globe-alt')
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label('Group Description')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('logo')
                    ->label('Group Logo')
                    ->disk('public')
                    ->imageEditor()
                    ->image()
                    ->visibility('public')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('group_link')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Group Logo')
                    ->disk('public')
                    ->circular(),
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
                Tables\Actions\DeleteAction::make()
                
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
            'index' => Pages\ListCommunityGroups::route('/'),
            'create' => Pages\CreateCommunityGroups::route('/create'),
            'edit' => Pages\EditCommunityGroups::route('/{record}/edit'),
        ];
    }
}
