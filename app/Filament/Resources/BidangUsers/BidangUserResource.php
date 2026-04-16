<?php

namespace App\Filament\Resources\BidangUsers;

use App\Filament\Resources\BidangUsers\Pages\CreateBidangUser;
use App\Filament\Resources\BidangUsers\Pages\EditBidangUser;
use App\Filament\Resources\BidangUsers\Pages\ListBidangUsers;
use App\Filament\Resources\BidangUsers\Pages\ViewBidangUser;
use App\Filament\Resources\BidangUsers\Schemas\BidangUserForm;
use App\Filament\Resources\BidangUsers\Schemas\BidangUserInfolist;
use App\Filament\Resources\BidangUsers\Tables\BidangUsersTable;
use App\Models\BidangUser;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BidangUserResource extends Resource
{
    protected static ?string $model = BidangUser::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = null;

    public static function form(Schema $schema): Schema
    {
        return BidangUserForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BidangUserInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BidangUsersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBidangUsers::route('/'),
            'create' => CreateBidangUser::route('/create'),
            'view' => ViewBidangUser::route('/{record}'),
            'edit' => EditBidangUser::route('/{record}/edit'),
        ];
    }
}
