<?php

namespace App\Filament\Resources\Companysettings;

use App\Filament\Resources\Companysettings\Pages\CreateCompanysettings;
use App\Filament\Resources\Companysettings\Pages\EditCompanysettings;
use App\Filament\Resources\Companysettings\Pages\ListCompanysettings;
use App\Filament\Resources\Companysettings\Pages\ViewCompanysettings;
use App\Filament\Resources\Companysettings\Schemas\CompanysettingsForm;
use App\Filament\Resources\Companysettings\Schemas\CompanysettingsInfolist;
use App\Filament\Resources\Companysettings\Tables\CompanysettingsTable;
use App\Models\Companysetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Redirect;
use UnitEnum;

class CompanysettingsResource extends Resource
{
    protected static ?string $model = Companysetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Setting';

    protected static ?int $navigationGroupSort = 1;

    protected static ?string $navigationLabel = 'Profile Organisasi';

    protected static ?string $modelLabel = 'Profile Organisasi';

    protected static ?string $pluralModelLabel = 'Profile Organisasi';

    protected static ?string $recordTitleAttribute = 'nama_organisasi';

    public static function form(Schema $schema): Schema
    {
        return CompanysettingsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CompanysettingsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CompanysettingsTable::configure($table);
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
            'index' => ListCompanysettings::route('/'),
            'create' => CreateCompanysettings::route('/create'),
            'view' => ViewCompanysettings::route('/{record}'),
            'edit' => EditCompanysettings::route('/{record}/edit'),
        ];
    }

    public static function getNavigationUrl(): string
    {
        // Cari record pertama
        $record = static::getModel()::first();

        if ($record) {
            // Jika ada record, redirect ke halaman edit
            return static::getUrl('edit', ['record' => $record->id]);
        }

        // Jika tidak ada, redirect ke create
        return static::getUrl('create');
    }
}
