<?php

namespace App\Filament\Resources\RegionalOrganizationResource\Pages;

use App\Filament\Resources\RegionalOrganizationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRegionalOrganization extends EditRecord
{
    protected static string $resource = RegionalOrganizationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Удалить'),
        ];
    }
}
