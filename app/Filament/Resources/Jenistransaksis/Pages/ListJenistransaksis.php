<?php

namespace App\Filament\Resources\Jenistransaksis\Pages;

use App\Filament\Resources\Jenistransaksis\JenistransaksiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJenistransaksis extends ListRecords
{
    protected static string $resource = JenistransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
