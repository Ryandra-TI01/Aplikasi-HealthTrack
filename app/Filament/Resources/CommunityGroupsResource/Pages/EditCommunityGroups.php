<?php

namespace App\Filament\Resources\CommunityGroupsResource\Pages;

use App\Filament\Resources\CommunityGroupsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCommunityGroups extends EditRecord
{
    protected static string $resource = CommunityGroupsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
