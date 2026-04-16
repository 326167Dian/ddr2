<?php

namespace App\Filament\Resources\ProgramKerjas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProgramKerjaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('bidang_id')
                    ->numeric(),
                TextEntry::make('nama_program'),
                TextEntry::make('slug'),
                TextEntry::make('deskripsi')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('tujuan')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('periode'),
                TextEntry::make('status'),
                TextEntry::make('created_by')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
