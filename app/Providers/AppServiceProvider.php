<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Kategori;     // Import Model Kategori
use App\Policies\KategoriPolicy; // Import Policy Kategori

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // ... (policy-policy lain, jika ada)
        
        // Pendaftaran Policy Kategori Anda:
        Kategori::class => KategoriPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // ...
    }
}