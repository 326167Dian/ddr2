<?php

namespace App\Filament\Resources\Companysettings\Pages;

use App\Filament\Resources\Companysettings\CompanysettingsResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCompanysettings extends EditRecord
{
    protected static string $resource = CompanysettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
