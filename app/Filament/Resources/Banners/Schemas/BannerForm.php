<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255),
                Select::make('title')
                    ->label('Title')
                    ->options([
                        'banner struktur organisasi' => 'Banner Struktur Organisasi',
                        'banner artikel & berita' => 'Banner artikel & berita',
                        'banner kegiatan' => 'Banner kegiatan',
                        'banner sejarah organisasi' => 'Banner sejarah organisasi',
                        'banner seminar' => 'Banner seminar',
                        'banner home' => 'Banner Home',
                    ]),
                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->required()
                    ->autosize()
                    ->columnSpanFull(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Aktif',
                        'inactive' => 'Tidak Aktif'
                    ])
                    ->required(),
                FileUpload::make('foto')
                    ->label('Foto')
                    ->image()
                    ->required()
                    ->disk('public')
                    ->visibility('public')
                    ->directory('banners')
                    ->columnSpanFull(),
            ]);
    }
}
