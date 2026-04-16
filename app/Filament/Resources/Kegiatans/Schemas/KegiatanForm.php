<?php

namespace App\Filament\Resources\Kegiatans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class KegiatanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Kegiatan')
                    ->schema([
                        \Filament\Forms\Components\Select::make('program_kerja_id')
                            ->relationship('programKerja', 'nama_program')
                            ->searchable()
                            ->preload()
                            ->required(),
                        \Filament\Forms\Components\Select::make('bidang_id')
                            ->relationship('bidang', 'name')
                            ->searchable()
                            ->preload()
                            ->default(fn () => auth()->user()->bidangs->first()?->id)
                            ->disabled()
                            ->dehydrated()
                            ->required(),
                        TextInput::make('nama_kegiatan')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        TextInput::make('slug')
                            ->disabled()
                            ->dehydrated()
                            ->required(),
                        \Filament\Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'berjalan' => 'Berjalan',
                                'selesai' => 'Selesai',
                                'dibatalkan' => 'Dibatalkan',
                            ])
                            ->required()
                            ->default('draft'),
                    ])->columns(2),

                Section::make('Detail & Media')
                    ->schema([
                        \Filament\Forms\Components\RichEditor::make('deskripsi')
                            ->columnSpanFull(),
                        TextInput::make('lokasi'),
                        \Filament\Forms\Components\FileUpload::make('foto')
                            ->disk('public')
                            ->directory('kegiatan-photos')
                            ->visibility('public')
                            ->image()
                            ->imageEditor()
                            ->columnSpanFull(),
                    ]),

                Section::make('Pelaksanaan & Anggaran')
                    ->schema([
                        DatePicker::make('tanggal_mulai')
                            ->required(),
                        DatePicker::make('tanggal_selesai'),
                        TextInput::make('anggaran')
                            ->numeric()
                            ->prefix('Rp'),
                    ])->columns(3),

                \Filament\Forms\Components\Hidden::make('created_by')
                    ->default(fn () => auth()->id())
                    ->required(),
            ]);
    }
}
