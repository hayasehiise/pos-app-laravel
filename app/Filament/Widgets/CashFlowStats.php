<?php

namespace App\Filament\Widgets;

use App\Models\Pengeluaran;
use App\Models\Penjualan;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class CashFlowStats extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 2;

    public Carbon $from;
    public Carbon $to;

    /**
     * Ambil total dan chart data untuk model tertentu
     * @param class-string<Model> $model
     * @param string $dateColumn
     * @param string $amountColumn
     * @return array [total, chartData[]]
     */
    protected function getData(string $model, string $dateColumn, string $amountColumn): array
    {
        $query = $model::query()
            ->whereBetween($dateColumn, [$this->from, $this->to]);

        $total = $query->sum($amountColumn);

        $chart = $query->clone()
            ->selectRaw("DATE($dateColumn) as tgl, COUNT(*) as total")
            ->groupBy('tgl')
            ->orderBy('tgl')
            ->pluck('total')
            ->toArray();

        return [$total, $chart];
    }

    protected function getStats(): array
    {
        $this->from = Carbon::parse($this->pageFilters['startDate'] ?? now()->startOfMonth());
        $this->to = Carbon::parse($this->pageFilters['endDate'] ?? now()->endOfMonth());

        [$totalIncome, $chartIncome] = $this->getData(Penjualan::class, 'tanggal_penjualan', 'total_harga');
        [$totalExpense, $chartExpense] = $this->getData(Pengeluaran::class, 'tanggal_pengeluaran', 'total_pengeluaran');

        $balance = $totalIncome - $totalExpense;

        return [
            Stat::make('Total Pemasukan', 'Rp' . number_format($totalIncome, 0, ',', '.'))
                ->icon('tabler-shopping-cart-plus')
                ->chart($chartIncome)
                ->color('success'),
            Stat::make('Total Pengeluaran', 'Rp' . number_format($totalExpense, 0, ',', '.'))
                ->icon('tabler-shopping-cart-minus')
                ->chart($chartExpense)
                ->color('danger'),
            Stat::make('Saldo Akhir', 'Rp' . number_format($balance, 0, ',', '.'))
                ->icon('tabler-wallet'),
        ];
    }
}
