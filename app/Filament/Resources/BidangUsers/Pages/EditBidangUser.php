<?php

namespace App\Filament\Resources\BidangUsers\Pages;

use App\Filament\Resources\BidangUsers\BidangUserResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditBidangUser extends EditRecord
{
    protected static string $resource = BidangUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
