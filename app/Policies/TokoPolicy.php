<?php

namespace App\Policies;

use App\Models\Toko;
use App\Models\User;

class TokoPolicy
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
        if ($user->hasRole('admin')) {
            return true;
        }
        return null;
    }


    public function viewAny(User $user): bool
    {
        return false;
    }
    public function view(User $user, Toko $toko): bool
    {
        return false;
    }
    public function create(User $user): bool
    {
        return false;
    }
    public function update(User $user, Toko $toko): bool
    {
        return false;
    }
    public function delete(User $user, Toko $toko): bool
    {
        return false;
    }
}
