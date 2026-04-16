<?php

namespace App\Filament\Resources\JurnalKas\Pages;

use App\Filament\Resources\JurnalKas\JurnalKasResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewJurnalKas extends ViewRecord
{
    protected static string $resource = JurnalKasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
