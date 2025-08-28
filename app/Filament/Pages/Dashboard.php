<?php

namespace App\Filament\Pages;

// use Filament\Pages\Page;

use App\Filament\Widgets\AdminStats;
use App\Filament\Widgets\CashComparisonPengeluaranChart;
use App\Filament\Widgets\CashComparisonPenjualanChart;
use App\Filament\Widgets\CashFlowChart;
use Filament\Pages\Dashboard as BaseDashboard;

use App\Filament\Widgets\CashFlowStats;
use App\Filament\Widgets\FilterLaporanPrint;
use Filament\Actions\Action;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Flex;
use Filament\Widgets\AccountWidget;

class Dashboard extends BaseDashboard
{
    // protected string $view = 'filament.pages.dashboard';

    protected static ?string $navigationLabel = "Dashboard";
    protected static ?string $title = "Dashboard";

    use HasFiltersForm;

    public function filtersForm(Schema $schema): Schema
    {
        $user = auth()->user();
        if ($user->hasRole('admin')) {
            return $schema->components([]);
        }
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Flex::make([
                            DatePicker::make('startDate')
                                ->default(now()->startOfMonth())
                                ->reactive(),
                            DatePicker::make('endDate')
                                ->default(now()->endOfMonth())
                                ->reactive(),
                        ])
                            ->verticallyAlignCenter()
                    ])
                    ->columns(1)
                    ->columnSpan(2),
            ]);
    }

    public function getHeaderWidgets(): array
    {
        return [
            FilterLaporanPrint::class,
            AccountWidget::class,
        ];
    }

    public function getWidgets(): array
    {
        $user = auth()->user();
        if ($user->hasRole('admin')) {
            return [
                AdminStats::class,
            ];
        }

        // ketika role selain admin
        return [
            CashFlowStats::class,
            CashFlowChart::class,
            CashComparisonPenjualanChart::class,
            CashComparisonPengeluaranChart::class,
        ];
    }

    public static function canAccess(): bool
    {
        return auth()->check();
    }
}
