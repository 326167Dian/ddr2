<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\DashboardStatsWidget;
use App\Filament\Widgets\EventsChartWidget;
use App\Filament\Widgets\RegistrationsChartWidget;
use App\Filament\Widgets\FinanceStatsWidget;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Icons\Heroicon;

class Dashboard extends BaseDashboard
{
    protected static string|null|\BackedEnum $navigationIcon = Heroicon::OutlinedHome;

    protected static ?int $navigationSort = -1;

    public function getColumns(): int | array
    {
        return 2;
    }

    public function getWidgets(): array
    {
        return [
            FinanceStatsWidget::class,
            DashboardStatsWidget::class,
            EventsChartWidget::class,
            RegistrationsChartWidget::class,
        ];
    }
}
