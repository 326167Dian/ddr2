<?php

namespace App\Filament\Resources\Jenistransaksis\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class JenistransaksiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_transaksi')->label('Nama Transaksi')->required(),
                Select::make('tipe_transaksi')->label('Tipe Transaksi')->options([
                    'MASUK' => 'MASUK',
                    'KELUAR' => 'KELUAR',
                ])->required(),
            ]);
    }
}
