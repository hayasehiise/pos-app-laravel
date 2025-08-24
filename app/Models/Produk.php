<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    /** @use HasFactory<\Database\Factories\ProdukFactory> */
    use HasFactory;

    protected $fillable = [
        'toko_id',
        'nama_produk',
        'deskripsi',
        'harga_jual',
        'stock',
    ];

    public function toko(): BelongsTo
    {
        return $this->belongsTo(Toko::class);
    }
    public function penjualan(): HasMany
    {
        return $this->hasMany(Penjualan::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('user_toko', function ($query) {
            $user = auth()->user();

            if ($user && ($user->hasRole('owner') || $user->hasRole('kasir'))) {
                $query->where('toko_id', $user->toko_id);
            }
        });
    }
}
