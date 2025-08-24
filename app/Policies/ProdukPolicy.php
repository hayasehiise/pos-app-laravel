<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Produk;

class ProdukPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function before(User $user, string $ability): ?bool
    {
        // kalau mau untuk super admin
        return null;
    }
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('owner') || $user->hasRole('kasir');
    }
    public function view(User $user, Produk $model): bool
    {
        if ($user->hasRole('admin')) return true;
        if ($user->hasRole('owner')) return $user->toko_id === $model->toko_id;
        if ($user->hasRole('kasir')) return $user->toko_id === $model->toko_id;
        return false;
    }
    public function create(User $user): bool
    {
        return $user->hasRole('owner') || $user->hasRole('kasir');
    }
    public function update(User $user, Produk $model): bool
    {
        if ($user->hasRole('owner')) return $user->toko_id === $model->toko_id;
        if ($user->hasRole('kasir')) return $user->toko_id === $model->toko_id;
        return false;
    }
    public function delete(User $user, Produk $model): bool
    {
        return $user->hasRole('admin') || $user->hasRole('owner');
    }
}
