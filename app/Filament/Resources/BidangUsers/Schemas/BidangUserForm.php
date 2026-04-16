<?php

namespace App\Filament\Resources\BidangUsers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class BidangUserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Nama User')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('bidang_id')
                    ->relationship('bidang', 'name')
                    ->label('Bidang')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('bidang_role_id')
                    ->relationship('role', 'name')
                    ->label('Jabatan')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
