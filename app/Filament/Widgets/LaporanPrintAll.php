<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class LaporanPrintAll extends Widget
{
    protected string $view = 'filament.widgets.laporan-print-all';

    protected int|string|array $columnSpan = 'full';
}
