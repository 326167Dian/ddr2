<?php

namespace App\Filament\Resources\Companysettings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class CompanysettingsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('logo')
                    ->label('Logo')
                    ->image()
                    ->nullable()
                    ->disk('public')
                    ->visibility('public')
                    ->directory('companysettings/logos'),
                TextInput::make('nama_organisasi')
                    ->label('Nama Organisasi')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email Kontak')
                    ->email()
                    ->nullable()
                    ->maxLength(255),
                TextInput::make('no_tlp')
                    ->label('Telepon')
                    ->nullable()
                    ->maxLength(255),
                Textarea::make('alamat')
                    ->label('Alamat')
                    ->nullable()
                    ->autosize(),
                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->nullable()
                    ->autosize(),
            ]);
    }
}
