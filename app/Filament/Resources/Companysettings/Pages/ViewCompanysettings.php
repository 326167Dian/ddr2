<?php

namespace App\Filament\Resources\Companysettings\Pages;

use App\Filament\Resources\Companysettings\CompanysettingsResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCompanysettings extends ViewRecord
{
    protected static string $resource = CompanysettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
