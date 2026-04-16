<?php

namespace App\Filament\Resources\BidangUsers\Pages;

use App\Filament\Resources\BidangUsers\BidangUserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBidangUsers extends ListRecords
{
    protected static string $resource = BidangUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
