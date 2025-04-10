<?php

namespace App\Filament\Resources\HealthTypeResource\Pages;

use App\Filament\Resources\HealthTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHealthType extends EditRecord
{
    protected static string $resource = HealthTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
