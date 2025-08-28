<x-filament-widgets::widget>
    <x-filament::section>
        {{-- Widget content --}}
        <p class="text-lg font-bold mb-3">Print Laporan</p>
        <form action="{{ $this->submit() }}" method="GET" target="_blank">
            <div class="flex gap-5">
                <x-filament::input.wrapper class="flex-1">
                    <x-filament::input type="date" wire:model='start_date' name="start_date"
                        value="{{ now()->startOfMonth() }}" />
                </x-filament::input.wrapper>
                <x-filament::input.wrapper class="flex-1">
                    <x-filament::input type="date" wire:model='end_date' name="end_date"
                        value="{{ now()->endOfMonth() }}" />
                </x-filament::input.wrapper>
            </div>
            <x-filament::button type="submit" class="mt-4">
                Print Laporan
            </x-filament::button>
        </form>
    </x-filament::section>
</x-filament-widgets::widget>
