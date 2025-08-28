<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Widgets\Widget;

class FilterLaporanPrint extends Widget implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.widgets.filter-laporan-print';

    protected static bool $isLazy = false;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'start_date' => Carbon::now()->startOfMonth(),
            'end_date' => Carbon::now()->endOfMonth(),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                DatePicker::make('start_date')
                    ->label('Dari Tanggal'),
                DatePicker::make('end_date')
                    ->label('Sampai Tanggal'),
                $this->printAction(),
            ])
            ->statePath('data');
    }

    public function printAction(): Action
    {
        return Action::make()
            ->label('Print')
            ->action('submit');
    }

    public function submit()
    {
        $start = $this->data['start_date'] ?? null;
        $end = $this->data['end_date'] ?? null;

        return redirect()->route('laporan.print', [
            'start_date' => $start,
            'end_date' => $end
        ]);
    }
}
