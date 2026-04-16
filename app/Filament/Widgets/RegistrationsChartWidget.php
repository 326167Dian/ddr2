<?php

namespace App\Filament\Widgets;

use App\Models\Registration;
use Filament\Widgets\ChartWidget;

class RegistrationsChartWidget extends ChartWidget
{
    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 1;

    public function getHeading(): ?string
    {
        return 'Registrasi per Bulan';
    }

    protected function getData(): array
    {
        $data = Registration::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('count', 'month');

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $chartData = [];

        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $data[$i] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Registrasi',
                    'data' => $chartData,
                    'borderColor' => '#10b981',
                    'backgroundColor' => '#d1fae5',
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
