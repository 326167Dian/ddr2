<?php

namespace App\Filament\Resources\ProgramKerjas;

use App\Filament\Resources\ProgramKerjas\Pages\CreateProgramKerja;
use App\Filament\Resources\ProgramKerjas\Pages\EditProgramKerja;
use App\Filament\Resources\ProgramKerjas\Pages\ListProgramKerjas;
use App\Filament\Resources\ProgramKerjas\Pages\ViewProgramKerja;
use App\Filament\Resources\ProgramKerjas\Schemas\ProgramKerjaForm;
use App\Filament\Resources\ProgramKerjas\Schemas\ProgramKerjaInfolist;
use App\Filament\Resources\ProgramKerjas\Tables\ProgramKerjasTable;
use App\Models\ProgramKerja;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProgramKerjaResource extends Resource
{
    protected static ?string $model = ProgramKerja::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPresentationChartLine;

    protected static string|UnitEnum|null $navigationGroup = 'Program & Kegiatan';

    protected static ?int $navigationGroupSort = 2;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Program Kerja';

    protected static ?string $recordTitleAttribute = 'nama_program';

    public static function form(Schema $schema): Schema
    {
        return ProgramKerjaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProgramKerjaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProgramKerjasTable::configure($table);
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
            'index' => ListProgramKerjas::route('/'),
            'create' => CreateProgramKerja::route('/create'),
            'view' => ViewProgramKerja::route('/{record}'),
            'edit' => EditProgramKerja::route('/{record}/edit'),
        ];
    }
}
