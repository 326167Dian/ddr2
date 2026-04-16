<?php

namespace App\Filament\Resources\Jenistransaksis\Pages;

use App\Filament\Resources\Jenistransaksis\JenistransaksiResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditJenistransaksi extends EditRecord
{
    protected static string $resource = JenistransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
