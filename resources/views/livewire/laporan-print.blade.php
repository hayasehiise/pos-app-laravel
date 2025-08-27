<div class="flex flex-col">
    {{-- Do your work, then step back. --}}
    <h1 class="text-3xl text-center font-extrabold uppercase">Laporan</h1>

    {{-- Tabel Produk --}}
    <h2 class="text-2xl px-6 font-bold uppercase mt-6">Produk</h2>
    <table class="w-full border-separate table-auto">
        <thead>
            <tr class=" bg-black text-white">
                <td class="p-5 text-center uppercase w-10">#</td>
                <td class="p-5 text-center uppercase">Nama Produk</td>
                <td class="p-5 text-center uppercase">Sisa Stock</td>
                <td class="p-5 text-center uppercase">Jumlah Terjual</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($produk as $item)
                <tr class="border bg-gray-200">
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="px-5 py-2">{{ $item->nama_produk }}</td>
                    <td class="px-5 py-2">{{ $item->stock }}</td>
                    <td class="px-5 py-2">{{ $item->penjualan->sum('quantitas') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="border bg-gray-700 text-white">
                <td class="px-5 py-2 font-bold" colspan="3">Total Produk Terjual</td>
                <td class="px-5 py-2 font-bold">{{ $penjualan->sum('quantitas') }}</td>
            </tr>
        </tfoot>
    </table>

    {{-- Page Break --}}
    <div class="page-break"></div>

    {{-- Table Penjualan --}}
    <h2 class="text-2xl px-6 font-bold uppercase">Penjualan</h2>
    <table class="w-full border-separate table-auto">
        <thead>
            <tr class="bg-black text-white">
                <td class="p-5 text-center uppercase w-10">#</td>
                <td class="p-5 text-center uppercase">Nama Produk</td>
                <td class="p-5 text-center uppercase">Tanggal Penjualan</td>
                <td class="p-5 text-center uppercase">Quantitas</td>
                <td class="p-5 text-center uppercase">Diskon</td>
                <td class="p-5 text-center uppercase">Total</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualan as $item)
                <tr class="border bg-gray-200">
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="px-5 py-2">{{ $item->produk->nama_produk }}</td>
                    <td class="px-5 py-2">{{ date_format($item->tanggal_penjualan, 'd/m/Y') }}</td>
                    <td class="px-5 py-2">{{ $item->quantitas }}</td>
                    <td class="px-5 py-2">{{ $item->diskon > 0 ? $item->diskon . '%' : 'Tanpa Diskon' }}</td>
                    <td class="px-5 py-2">{{ 'Rp' . number_format($item->total_harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="border bg-gray-700 text-white">
                <td class="px-5 py-2 font-bold" colspan="5">Total Hasil Penjualan</td>
                <td class="px-5 py-2 font-bold">{{ 'Rp' . number_format($penjualan->sum('total_harga'), 0, ',', '.') }}
                </td>
            </tr>
        </tfoot>
    </table>

    {{-- Page Break --}}
    <div class="page-break"></div>

    {{-- Table Penjualan --}}
    <h2 class="text-2xl px-6 font-bold uppercase">Pengeluaran</h2>
    <table class="w-full border-separate table-auto">
        <thead>
            <tr class="bg-black text-white">
                <td class="p-5 text-center uppercase w-10">#</td>
                <td class="p-5 text-center uppercase">Jenis Pengeluaran</td>
                <td class="p-5 text-center uppercase">Tanggal Pengeluaran</td>
                <td class="p-5 text-center uppercase">Total Pengeluaran</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengeluaran as $item)
                <tr class="border bg-gray-200">
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="px-5 py-2">{{ $item->deskripsi }}</td>
                    <td class="px-5 py-2">{{ date_format($item->tanggal_pengeluaran, 'd/m/Y') }}</td>
                    <td class="px-5 py-2">{{ 'Rp' . number_format($item->total_pengeluaran, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="border bg-gray-700 text-white">
                <td class="px-5 py-2 font-bold" colspan="3">Total Hasil Pengeluaran</td>
                <td class="px-5 py-2 font-bold">
                    {{ 'Rp' . number_format($pengeluaran->sum('total_pengeluaran'), 0, ',', '.') }}
                </td>
            </tr>
        </tfoot>
    </table>
</div>
