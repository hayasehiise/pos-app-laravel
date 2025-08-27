<?php

namespace App\Filament\Widgets;

use App\Models\Pengeluaran;
use Filament\Widgets\ChartWidget;

class CashComparisonPengeluaranChart extends ChartWidget
{
    protected ?string $heading = 'Cash Comparison Pengeluaran Chart';

    protected int|string|array $columnSpan = 1;

    protected ?string $pollingInterval = null;

    protected function getMonthlyData(string $model, string $column, string $sumColumn): array
    {
        $now = now();
        $thisMonth = $now->month;
        $thisYear = $now->year;

        $lastMonth = $now->copy()->subMonth()->month;
        $lastMonthYear = $now->copy()->subMonth()->year;

        $thisMonthData = $model::whereYear($column, $thisYear)
            ->whereMonth($column, $thisMonth)
            ->sum($sumColumn);

        $lastMontData = $model::whereYear($column, $lastMonthYear)
            ->whereMonth($column, $lastMonth)
            ->sum($sumColumn);

        return [$lastMontData, $thisMonthData];
    }

    protected function getData(): array
    {
        [$lastMontData, $thisMonthData] = $this->getMonthlyData(Pengeluaran::class, 'tanggal_pengeluaran', 'total_pengeluaran');
        return [
            'datasets' => [[
                'label' => 'Pengeluaran',
                'data' => [$lastMontData, $thisMonthData],
                'backgroundColor' => ['oklch(0.6055 0.1828 26.05)', 'oklch(0.5249 0.1828 26.05)']
            ]],
            'labels' => ['Bulan Kemarin', 'Bulan ini']
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
