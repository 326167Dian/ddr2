<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Schema;
use Filament\Forms\Components\RichEditor;
use Illuminate\Support\Str;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($set, ?string $state) => $set('slug', Str::slug($state))),

                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                RichEditor::make('content')
                    ->label('Konten')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'link',
                        'orderedList',
                        'bulletList',
                        'blockquote',
                        'codeBlock',
                    ])
                    ->required(),

                Hidden::make('author_id')
                    ->default(fn() => Filament::auth()->id()),

                DateTimePicker::make('published_at')
                    ->label('Tanggal & Jam Publish')
                    ->seconds(false)
                    ->native(false)
                    ->displayFormat('Y-m-d H:i')
                    ->default(now()),

                FileUpload::make('banner')
                    ->label('Banner')
                    ->image()
                    ->disk('public')
                    ->directory('articlebanners')
                    ->imagePreviewHeight('200')
                    ->downloadable()
                    ->openable()
                    ->maxSize(2048)
                    ->deletable(true)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg']),
            ]);
    }
}
