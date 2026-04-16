<?php

namespace App\Filament\Resources\Jenistransaksis\Pages;

use App\Filament\Resources\Jenistransaksis\JenistransaksiResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewJenistransaksi extends ViewRecord
{
    protected static string $resource = JenistransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
