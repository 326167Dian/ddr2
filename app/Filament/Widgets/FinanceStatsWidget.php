<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class FinanceStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $data = DB::table('jurnal_kas')
            ->join('jenis_transaksis', 'jurnal_kas.jenis_transaksi_id', '=', 'jenis_transaksis.id')
            ->where('jurnal_kas.status', 'approved')
            ->selectRaw('
                COALESCE(SUM(CASE WHEN jenis_transaksis.tipe_transaksi = "MASUK" THEN jurnal_kas.nominal ELSE 0 END), 0) as total_masuk,
                COALESCE(SUM(CASE WHEN jenis_transaksis.tipe_transaksi = "KELUAR" THEN jurnal_kas.nominal ELSE 0 END), 0) as total_keluar
            ')
            ->first();

        $totalMasuk = $data->total_masuk ?? 0;
        $totalKeluar = $data->total_keluar ?? 0;
        $saldo = $totalMasuk - $totalKeluar;

        return [
            Stat::make('Total Pemasukan', 'Rp ' . number_format($totalMasuk, 0, ',', '.'))
                ->description('Transaksi masuk (approved)')
                ->icon('heroicon-o-arrow-trending-up')
                ->color('success'),
            Stat::make('Total Pengeluaran', 'Rp ' . number_format($totalKeluar, 0, ',', '.'))
                ->description('Transaksi keluar (approved)')
                ->icon('heroicon-o-arrow-trending-down')
                ->color('danger'),
            Stat::make('Saldo', 'Rp ' . number_format($saldo, 0, ',', '.'))
                ->description($saldo >= 0 ? 'Saldo positif' : 'Saldo negatif')
                ->icon('heroicon-o-banknotes')
                ->color($saldo >= 0 ? 'info' : 'warning'),
        ];
    }
}
