<?php

namespace App\Providers;

use App\Services\OrganizationContext;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(OrganizationContext::class);
    }

    public function boot(): void
    {
        //
    }
}
