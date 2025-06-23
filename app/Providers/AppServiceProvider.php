<?php

namespace App\Providers;

use App\Models\Umkm;
use Illuminate\Support\Facades\View; 
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {


        View::composer(['layouts.app', 'layouts.admin'], function ($view) {
            $tiketBaru = Umkm::where('status', 'open')->count();
            $view->with('tiketBaru', $tiketBaru);
        });
    }
}