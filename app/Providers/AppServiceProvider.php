<?php

namespace App\Providers;

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
        // Self-healing: Create missing storage framework directories if they don't exist
        $paths = [
            storage_path('framework/sessions'),
            storage_path('framework/views'),
            storage_path('framework/cache/data'),
            storage_path('logs'),
            base_path('bootstrap/cache'),
        ];

        foreach ($paths as $path) {
            if (!file_exists($path)) {
                mkdir($path, 0775, true);
            }
        }
    }
}
