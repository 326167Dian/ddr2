<?php

namespace App\Filament\Resources\Companysettings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Schema;

class CompanysettingsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('logo')
                    ->label('Logo'),
                TextEntry::make('nama_organisasi')
                    ->label('Nama Organisasi'),
                TextEntry::make('email')
                    ->label('Email Kontak'),
                TextEntry::make('no_tlp')
                    ->label('Telepon'),
                TextEntry::make('alamat')
                    ->label('Alamat'),
                TextEntry::make('deskripsi')
                    ->label('Deskripsi'),
            ]);
    }
}
