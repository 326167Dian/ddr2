<?php

namespace App\Filament\Resources\Kegiatans\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class KegiatanInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('program_kerja_id')
                    ->numeric(),
                TextEntry::make('bidang_id')
                    ->numeric(),
                TextEntry::make('nama_kegiatan'),
                TextEntry::make('slug'),
                TextEntry::make('deskripsi')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('lokasi')
                    ->placeholder('-'),
                TextEntry::make('tanggal_mulai')
                    ->date(),
                TextEntry::make('tanggal_selesai')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('anggaran')
                    ->numeric()
                    ->placeholder('-'),
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
