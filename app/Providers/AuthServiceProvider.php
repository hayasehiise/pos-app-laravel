<?php

namespace App\Providers;

use App\Models\Toko;
use App\Models\Produk;
use App\Policies\TokoPolicy;
use App\Policies\UserPolicy;
use App\Policies\ProdukPolicy;
// use Illuminate\Support\ServiceProvider;
use App\Models\User as UserModel;
use App\Policies\PengeluaranPolicy;
use App\Policies\PenjualanPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        UserModel::class => UserPolicy::class,
        Toko::class => TokoPolicy::class,
        Produk::class => ProdukPolicy::class,
        Penjualan::class => PenjualanPolicy::class,
        Pengeluaran::class => PengeluaranPolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
