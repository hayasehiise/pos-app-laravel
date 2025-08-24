<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Toko extends Model
{
    /** @use HasFactory<\Database\Factories\TokoFactory> */
    use HasFactory;

    protected $fillable = [
        'nama_toko',
        'alamat',
        'telp',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    public function produk(): HasMany
    {
        return $this->hasMany(Produk::class);
    }
}
