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
                    ->helperText('Judul yang tampil di atas gambar banner.')
                    ->required()
                    ->maxLength(255),
                Select::make('title')
                    ->label('Kategori Banner')
                    ->options([
                        'banner struktur organisasi' => 'Halaman Struktur Organisasi',
                        'banner artikel & berita' => 'Halaman Artikel & Berita',
                        'banner kegiatan' => 'Halaman Kegiatan',
                        'banner sejarah organisasi' => 'Halaman Sejarah Organisasi',
                        'banner seminar' => 'Halaman Seminar',
                        'banner home' => 'Halaman Home',
                    ])
                    ->helperText('Pilih halaman yang akan memakai banner ini.')
                    ->required(),
                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->helperText('Teks pendukung yang tampil di bawah judul banner.')
                    ->required()
                    ->autosize()
                    ->columnSpanFull(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Aktif',
                        'inactive' => 'Tidak Aktif'
                    ])
                    ->helperText('Hanya banner dengan status Aktif yang akan tampil di website.')
                    ->required(),
                FileUpload::make('foto')
                    ->label('Foto')
                    ->helperText('Upload gambar banner untuk halaman yang dipilih.')
                    ->image()
                    ->required()
                    ->disk('public')
                    ->visibility('public')
                    ->directory('banners')
                    ->columnSpanFull(),
            ]);
    }
}
