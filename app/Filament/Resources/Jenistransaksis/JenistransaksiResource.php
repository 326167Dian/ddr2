<?php

namespace App\Filament\Resources\Jenistransaksis;

use App\Filament\Resources\Jenistransaksis\Pages\CreateJenistransaksi;
use App\Filament\Resources\Jenistransaksis\Pages\EditJenistransaksi;
use App\Filament\Resources\Jenistransaksis\Pages\ListJenistransaksis;
use App\Filament\Resources\Jenistransaksis\Pages\ViewJenistransaksi;
use App\Filament\Resources\Jenistransaksis\Schemas\JenistransaksiForm;
use App\Filament\Resources\Jenistransaksis\Schemas\JenistransaksiInfolist;
use App\Filament\Resources\Jenistransaksis\Tables\JenistransaksisTable;
use App\Models\Jenistransaksi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JenistransaksiResource extends Resource
{
    protected static ?string $model = Jenistransaksi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama_transaksi';

    public static function form(Schema $schema): Schema
    {
        return JenistransaksiForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return JenistransaksiInfolist::configure($schema);
    }

    public static function shouldRegisterNavigation(): bool
    {
        // Sembunyikan resource dari sidebar
        return false;
    }


    public static function getNavigationLabel(): string
    {
        return 'Jenis Transaksi';
    }

    public static function table(Table $table): Table
    {
        return JenistransaksisTable::configure($table);
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
            'index' => ListJenistransaksis::route('/'),
            'create' => CreateJenistransaksi::route('/create'),
            'view' => ViewJenistransaksi::route('/{record}'),
            'edit' => EditJenistransaksi::route('/{record}/edit'),
        ];
    }
}
