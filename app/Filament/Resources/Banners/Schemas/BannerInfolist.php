<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Schema;

class BannerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('judul')
                    ->label('Judul'),
                TextEntry::make('deskripsi')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
                TextEntry::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                    }),
                ImageEntry::make('foto')
                    ->label('Foto')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->label('Dibuat')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime(),
            ]);
    }
}
