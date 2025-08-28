<?php

namespace App\Filament\Widgets;

use App\Models\Pengeluaran;
use App\Models\Penjualan;
use Carbon\CarbonPeriod;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Carbon;

class CashFlowChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'Cash Flow Chart';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected ?string $pollingInterval = null;
    protected static bool $isLazy = false;

    protected function getData(): array
    {
        $filterDateFrom = Carbon::parse($this->pageFilters['startDate'] ?? now()->startOfMonth());
        $filterDateTo = Carbon::parse($this->pageFilters['endDate'] ?? now()->endOfMonth());

        $period = CarbonPeriod::create($filterDateFrom, '1 day', $filterDateTo);
        $labels = [];
        $incomeData = [];
        $expenseData = [];

        foreach ($period as $date) {
            $day = $date->toDateString();

            $income = Penjualan::whereDate('tanggal_penjualan', $day)
                ->sum('total_harga');

            $expense = Pengeluaran::whereDate('tanggal_pengeluaran', $day)
                ->sum('total_pengeluaran');

            $labels[] = $date->format('d M');
            $incomeData[] = $income;
            $expenseData[] = $expense;
        }
        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Pemasukan',
                    'data' => $incomeData,
                    'backgroundColor' => 'oklch(0.7739 0.2092 141.46)',
                    'borderColor' => 'oklch(0.6302 0.2092 141.46)',
                    'fill' => true,
                ],
                [
                    'label' => 'Pengeluaran',
                    'data' => $expenseData,
                    'backgroundColor' => 'oklch(0.6312 0.2042 30.28)',
                    'borderColor' => 'oklch(0.6312 0.251 30.28)',
                    'fill' => true,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
