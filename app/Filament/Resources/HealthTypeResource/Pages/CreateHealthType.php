<?php

namespace App\Filament\Resources\HealthTypeResource\Pages;

use App\Filament\Resources\HealthTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHealthType extends CreateRecord
{
    protected static string $resource = HealthTypeResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
