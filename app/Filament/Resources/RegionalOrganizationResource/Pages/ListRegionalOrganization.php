<?php

namespace App\Filament\Resources\RegionalOrganizationResource\Pages;

use App\Filament\Resources\RegionalOrganizationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRegionalOrganizations extends ListRecords
{
    protected static string $resource = RegionalOrganizationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Создать организацию'),
        ];
    }
}
