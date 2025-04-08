<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IssueResource\Pages;
use App\Models\Issue;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class IssueResource extends Resource
{
    protected static ?string $model = Issue::class;
    protected static ?string $navigationIcon = 'heroicon-o-exclamation-circle';
    protected static ?string $navigationGroup = 'Solve & Share';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('User Name')
                    ->disabled()
                    ->dehydrated(false)
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->disabled()
                    ->dehydrated(false)
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->disabled()
                    ->dehydrated(false)
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('response')
                    ->label('Response')
                    ->autofocus()
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->label('Status ( Status will be resolved if response is provided )')
                    ->required()
                    ->options([
                        'open' => 'Open',
                        'in_progress' => 'In Progress',
                        'resolved' => 'Resolved',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'open' => 'danger',
                        'in_progress' => 'warning',
                        'resolved' => 'success',
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
                // Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListIssues::route('/'),
            'edit' => Pages\EditIssue::route('/{record}/edit'),
        ];
    }
}
