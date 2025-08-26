<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengeluaran extends Model
{
    /** @use HasFactory<\Database\Factories\PengeluaranFactory> */
    use HasFactory;

    protected $fillable = [
        'deskripsi',
        'tanggal_pengeluaran',
        'total_pengeluaran',
        'toko_id',
    ];

    protected $casts = [
        'tanggal_pengeluaran' => 'date',
    ];

    public function toko(): BelongsTo
    {
        return $this->belongsTo(Toko::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('pengeluaran_by_toko', function ($query) {
            $user = auth()->user();

            if ($user && ($user->hasRole('owner') || $user->hasRole('kasir'))) {
                $query->where('toko_id', $user->toko_id);
            }
        });
    }
}
