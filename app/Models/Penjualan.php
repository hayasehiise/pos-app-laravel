<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penjualan extends Model
{
    /** @use HasFactory<\Database\Factories\PenjualanFactory> */
    use HasFactory;

    protected $fillable = [
        'produk_id',
        'toko_id',
        'tanggal_penjualan',
        'quantitas',
        'diskon',
        'total_harga',
    ];

    protected $casts = [
        'tanggal_penjualan' => 'date',
    ];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class);
    }
    public function toko(): BelongsTo
    {
        return $this->belongsTo(Toko::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('penjualan_by_toko', function ($query) {
            $user = auth()->user();

            if ($user && ($user->hasRole('owner') || $user->hasRole('kasir'))) {
                $query->where('toko_id', $user->toko_id);
            }
        });

        static::created(function ($penjualan) {
            $penjualan->produk->decrement('stock', $penjualan->quantitas);
        });
        static::deleting(function ($penjualan) {
            $penjualan->produk->increment('stock', $penjualan->quantitas);
        });
        static::updating(function ($penjualan) {
            $originalQuantitas = $penjualan->getOriginal('quantitas');
            $newQuantitas = $penjualan->quantitas;
            $selisihQuantitas = $newQuantitas - $originalQuantitas;

            if ($selisihQuantitas > 0) {
                $penjualan->produk->decrement('stock', $selisihQuantitas);
            } elseif ($selisihQuantitas < 0) {
                $penjualan->produk->increment('stock', $selisihQuantitas);
            }
        });
    }
}
