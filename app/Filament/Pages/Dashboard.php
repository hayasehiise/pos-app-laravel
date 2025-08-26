<?php

namespace App\Filament\Pages;

// use Filament\Pages\Page;

use App\Filament\Widgets\CashFlowChart;
use Filament\Pages\Dashboard as BaseDashboard;

use App\Filament\Widgets\CashFlowStats;

use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Forms\Components\DatePicker;

class Dashboard extends BaseDashboard
{
    // protected string $view = 'filament.pages.dashboard';

    protected static ?string $navigationLabel = "Dashboard";
    protected static ?string $title = "Dashboard Utama";

    use HasFiltersForm;

    public function filtersForm(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        DatePicker::make('startDate')
                            ->default(now()->startOfMonth())
                            ->live(false),
                        DatePicker::make('endDate')
                            ->default(now()->endOfMonth())
                            ->live(false),
                    ])
                    ->columns(2),
            ])->columns(1);
    }

    public function getWidgets(): array
    {
        return [
            CashFlowStats::class,
            CashFlowChart::class,
        ];
    }

    public static function canAccess(): bool
    {
        return auth()->check();
    }
}
