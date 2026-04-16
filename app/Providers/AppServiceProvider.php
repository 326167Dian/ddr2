<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\View;
use App\Models\Companysetting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Filament::serving(function () {
            // Ubah favicon tab browser
            \Filament\Support\Facades\FilamentView::registerRenderHook(
                'panels::head.start',
                fn() => '<link rel="icon" type="image/png" href="' . asset('assets_frontend/img/logo.jpg') . '">'
            );
        });

        View::composer('frontend.layouts.*', function ($view) {
            $companyProfile = Companysetting::first();
            $view->with('companyProfile', $companyProfile);
        });
    }
}
