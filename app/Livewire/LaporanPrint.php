<?php

namespace App\Livewire;

use App\Models\Pengeluaran;
use App\Models\Penjualan;
use App\Models\Produk;
use Livewire\Component;

class LaporanPrint extends Component
{
    public $produk;
    public $penjualan;
    public $totalPenjualan;
    public $pengeluaran;
    public $totalPengeluaran;

    public function mount()
    {
        $from = request()->get('start_date');
        $to = request()->get('end_date');
        $toko = auth()->user()->toko_id;

        $this->produk = Produk::where('toko_id', $toko)->get();
        $this->penjualan = Penjualan::where('toko_id', $toko)->whereBetween('tanggal_penjualan', [$from, $to])->orderBy('tanggal_penjualan', 'asc')->get();
        $this->totalPenjualan = $this->penjualan->sum('total_harga');
        $this->pengeluaran = Pengeluaran::where('toko_id', $toko)->whereBetween('tanggal_pengeluaran', [$from, $to])->orderBy('tanggal_pengeluaran', 'asc')->get();
        $this->totalPengeluaran = $this->pengeluaran->sum('total_pengeluaran');
    }
    public function render()
    {
        return view('livewire.laporan-print')->layout('layouts.print');
    }
}
