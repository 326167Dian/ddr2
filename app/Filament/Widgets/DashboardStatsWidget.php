<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Banner;
use App\Models\Event;
use App\Models\Registration;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Artikel', Article::count())
                ->description('Jumlah artikel yang dipublikasikan')
                ->icon('heroicon-o-document-text')
                ->color('info'),
            Stat::make('Total Event', Event::count())
                ->description('Jumlah event yang tersedia')
                ->icon('heroicon-o-calendar-days')
                ->color('warning'),
            Stat::make('Total Registrasi', Registration::count())
                ->description('Jumlah pendaftar')
                ->icon('heroicon-o-user-group')
                ->color('success'),
            Stat::make('Total Banner', Banner::count())
                ->description('Jumlah banner aktif')
                ->icon('heroicon-o-rectangle-stack')
                ->color('danger'),
        ];
    }
}
