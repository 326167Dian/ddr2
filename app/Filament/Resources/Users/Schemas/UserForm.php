<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Models\Institusi;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Hash;

class UserForm
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
                TextInput::make('no_tlp')
                    ->label('No. Telepon')
                    ->required()
                    ->maxLength(20),
                Textarea::make('alamat')
                    ->required()
                    ->maxLength(500),
                TextInput::make('profesi')
                    ->label('Profesi')
                    ->maxLength(255),
                Select::make('suku')
                    ->label('Suku')
                    ->options([
                        'Limo Panjang' => 'Limo Panjang',
                        'lorem' => 'lorem',
                        'lorem 2' => 'lorem 2',
                        'lorem 3' => 'lorem 3',
                    ])
                    ->searchable()
                    ->preload(),
                FileUpload::make('foto')
                    ->label('Pasfoto')
                    ->image()
                    ->disk('public')
                    ->directory('Pasfoto')
                    ->imagePreviewHeight('200')
                    ->downloadable()
                    ->openable()
                    ->maxSize(2048)
                    ->deletable(true)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg']),
                Select::make('role')
                    ->options([
                        'ketua' => 'Ketua',
                        'wakil_ketua' => 'Wakil Ketua',
                        'sekretaris' => 'Sekretaris',
                        'bendahara' => 'Bendahara',
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
