<x-filament-widgets::widget>
    {{-- Widget content --}}
    <div class="flex justify-end">
        <x-filament::button color="primary" onclick="window.open('{{ route('laporan.print') }}', '_blank')">
            Print Laporan
        </x-filament::button>
    </div>
</x-filament-widgets::widget>
