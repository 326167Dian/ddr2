<?php

namespace App\Filament\Resources\BidangUsers\Pages;

use App\Filament\Resources\BidangUsers\BidangUserResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBidangUser extends ViewRecord
{
    protected static string $resource = BidangUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
