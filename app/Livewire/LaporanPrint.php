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
        $this->produk = Produk::all();
        $this->penjualan = Penjualan::all();
        $this->totalPenjualan = Penjualan::sum('total_harga');
        $this->pengeluaran = Pengeluaran::all();
        $this->totalPengeluaran = Pengeluaran::sum('total_pengeluaran');
    }
    public function render()
    {
        return view('livewire.laporan-print')->layout('layouts.print');
    }
}
