<?php

use App\Livewire\LaporanPrint;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/laporan/printAll', LaporanPrint::class)->name('laporan.print');
