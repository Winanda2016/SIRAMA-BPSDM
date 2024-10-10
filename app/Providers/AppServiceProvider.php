<?php

namespace App\Providers;

use App\Models\Komentar;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('auth.app', function ($view) {
            $komentar = Komentar::latest()->take(3)->get();
            $view->with('komentar', $komentar);
        });
    }
}
