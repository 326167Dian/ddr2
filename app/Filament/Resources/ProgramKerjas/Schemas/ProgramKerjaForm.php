<?php

namespace App\Filament\Resources\ProgramKerjas\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProgramKerjaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Umum')
                    ->schema([
                        \Filament\Forms\Components\Select::make('bidang_id')
                            ->relationship('bidang', 'name')
                            ->searchable()
                            ->preload()
                            ->default(fn () => auth()->user()->bidangs->first()?->id)
                            ->disabled()
                            ->dehydrated()
                            ->required(),
                        TextInput::make('nama_program')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        TextInput::make('slug')
                            ->disabled()
                            ->dehydrated()
                            ->required(),
                        TextInput::make('periode')
                            ->required(),
                        \Filament\Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'disetujui' => 'Disetujui',
                                'berjalan' => 'Berjalan',
                                'selesai' => 'Selesai',
                            ])
                            ->required()
                            ->default('draft'),
                    ])->columns(2),
                Section::make('Detail Program')
                    ->schema([
                        \Filament\Forms\Components\RichEditor::make('deskripsi')
                            ->columnSpanFull(),
                        Textarea::make('tujuan')
                            ->columnSpanFull(),
                    ]),
                \Filament\Forms\Components\Hidden::make('created_by')
                    ->default(fn () => auth()->id())
                    ->required(),
            ]);
    }
}
