<?php

namespace App\Filament\Resources\Companysettings\Pages;

use App\Filament\Resources\Companysettings\CompanysettingsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCompanysettings extends ListRecords
{
    protected static string $resource = CompanysettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
