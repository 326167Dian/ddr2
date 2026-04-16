<?php

namespace App\Filament\Resources\JurnalKas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\Action;
use App\Models\JurnalKas;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Support\Carbon;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Filament\Actions\BulkAction;
use Illuminate\Support\Collection;
use Filament\Tables\Filters\SelectFilter;

class JurnalKasTable
{
    public static function configure(Table $table): Table
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Donatur')
                    ->searchable()
                    ->description(fn($record) => $record->email . ($record->no_tlp ? ' | ' . $record->no_tlp : ''))
                    ->wrap(),
                
                TextColumn::make('tanggal')
                    ->date('d M Y')
                    ->sortable()
                    ->description(fn($record) => $record->metode),

                TextColumn::make('jenisTransaksi.nama_transaksi')
                    ->label('Transaksi')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color(fn($record) => $record->jenisTransaksi?->tipe_transaksi === 'MASUK' ? 'success' : 'danger'),

                TextColumn::make('nominal')
                    ->label('Nominal')
                    ->weight('bold')
                    ->formatStateUsing(fn($state, $record) => ($record->jenisTransaksi?->tipe_transaksi === 'MASUK' ? '+ ' : '- ') . 'Rp ' . number_format($state, 0, ',', '.'))
                    ->color(fn($record) => $record->jenisTransaksi?->tipe_transaksi === 'MASUK' ? 'success' : 'danger')
                    ->alignRight(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->icon(fn(string $state): string => match ($state) {
                        'waiting_approval' => 'heroicon-m-clock',
                        'approved'         => 'heroicon-m-check-circle',
                        'rejected'         => 'heroicon-m-x-circle',
                        default            => 'heroicon-m-question-mark-circle',
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'waiting_approval' => 'warning',
                        'approved'         => 'success',
                        'rejected'         => 'danger',
                        default            => 'secondary',
                    }),
                
                TextColumn::make('user.name')
                    ->label('Petugas')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'waiting_approval' => 'Waiting Approval',
                        'approved'         => 'Approved',
                        'rejected'         => 'Rejected',
                    ]),
                Filter::make('tanggal')
                    ->form([
                        DatePicker::make('tanggal')
                            ->label('Pilih Tanggal')
                            ->native(false),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['tanggal'],
                                fn($q, $date) =>
                                $q->whereDate('tanggal', $date)
                            );
                    }),

                Filter::make('rentang_tanggal')
                    ->form([
                        DatePicker::make('dari')->label('Dari'),
                        DatePicker::make('sampai')->label('Sampai'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['dari'], fn($q, $date) => $q->whereDate('tanggal', '>=', $date))
                            ->when($data['sampai'], fn($q, $date) => $q->whereDate('tanggal', '<=', $date));
                    }),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([

                ExportAction::make('export')
                    ->label('Export ke Excel')
                    ->exports([
                        ExcelExport::make()
                            ->fromTable()
                            ->withFilename(fn() => 'JurnalKas_' . now()->format('Y-m-d_His')),
                    ]),

                Action::make('Total Pengeluaran')
                    ->icon('heroicon-o-currency-dollar')
                    ->color('danger')
                    ->disabled()
                    ->label(function () use ($currentMonth, $currentYear) {
                        $totalPengeluaran = JurnalKas::whereMonth('created_at', $currentMonth)
                            ->whereYear('created_at', $currentYear)
                            ->whereHas('jenisTransaksi', fn($q) => $q->where('tipe_transaksi', 'KELUAR'))
                            ->sum('nominal');

                        return 'Total Pengeluaran (Bulan Ini): Rp ' . number_format($totalPengeluaran, 0, ',', '.');
                    }),

                Action::make('Total Pemasukan')
                    ->icon('heroicon-o-currency-dollar')
                    ->color('info')
                    ->disabled()
                    ->label(function () use ($currentMonth, $currentYear) {
                        $totalPemasukan = JurnalKas::whereMonth('created_at', $currentMonth)
                            ->whereYear('created_at', $currentYear)
                            ->whereHas('jenisTransaksi', fn($q) => $q->where('tipe_transaksi', 'MASUK'))
                            ->sum('nominal');

                        return 'Total Pemasukan (Bulan Ini): Rp ' . number_format($totalPemasukan, 0, ',', '.');
                    }),

                // Hanya tampil jika role = bendahara
                Action::make('Input Pemasukan')
                    ->icon('heroicon-o-plus-circle')
                    ->color('success')
                    ->label('Input Pemasukan')
                    ->url(route('filament.admin.resources.jurnal-kas.create', ['tipe' => 'MASUK']))
                    ->visible(fn() => auth()->user()?->role === 'bendahara'),

                Action::make('Input Pengeluaran')
                    ->icon('heroicon-o-minus-circle')
                    ->color('danger')
                    ->label('Input Pengeluaran')
                    ->url(route('filament.admin.resources.jurnal-kas.create', ['tipe' => 'KELUAR']))
                    ->visible(fn() => auth()->user()?->role === 'bendahara'),

                Action::make('Tambah Jenis Transaksi')
                    ->icon('heroicon-o-plus-circle')
                    ->color('info')
                    ->label('Jenis Transaksi')
                    ->url(route('filament.admin.resources.jenistransaksis.index'))
                    ->visible(fn() => auth()->user()?->role === 'bendahara'),

                BulkActionGroup::make([
                    BulkAction::make('approveSelected')
                        ->label('Approve Selected')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function (Collection $records) {
                            $records
                                ->where('status', 'waiting_approval')
                                ->each
                                ->update(['status' => 'approved']);
                        }),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
