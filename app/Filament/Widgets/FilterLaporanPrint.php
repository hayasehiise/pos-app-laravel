<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class FilterLaporanPrint extends Widget
{

    protected string $view = 'filament.widgets.filter-laporan-print';

    protected static bool $isLazy = false;

    public ?string $start_date = null;
    public ?string $end_date = null;

    public function submit()
    {
        return route('laporan.print', [
            'start_date' => $this->start_date,
            'end_date' => $this->end_date
        ]);
    }
}
