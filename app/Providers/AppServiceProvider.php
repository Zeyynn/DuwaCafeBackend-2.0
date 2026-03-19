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
        $moduleNamespaces = array_map(
            fn(string $dir) => 'Modules\\' . basename($dir) . '\\Models',
            glob(base_path('Modules/*'), GLOB_ONLYDIR) ?: []
        );

        config([
            'lighthouse.namespaces.models' => array_merge(
                (array) config('lighthouse.namespaces.models'),
                $moduleNamespaces
            )
        ]);
    }
}
