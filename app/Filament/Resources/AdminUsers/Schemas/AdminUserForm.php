<?php

namespace App\Filament\Resources\AdminUsers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;

class AdminUserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->required()
                    ->email()
                    ->maxLength(255),
                Select::make('role')
                    ->options([
                        'admin' => 'admin',
                    ])
                    ->required(),
                // 🔒 Tambah input password
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->revealable() // bisa toggle tampilkan password
                    ->required(fn($context) => $context === 'create') // wajib saat create
                    ->dehydrated(fn($state) => filled($state)) // hanya disimpan kalau diisi
                    ->afterStateHydrated(function ($component, $state) {
                        $component->state(''); // kosongkan agar tidak menampilkan password hash
                    })
                    ->dehydrateStateUsing(fn($state) => !empty($state) ? Hash::make($state) : null),
            ]);
    }
}
