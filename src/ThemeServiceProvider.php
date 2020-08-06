<?php
namespace Codificar\Themes;
use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        $this->loadViewsFrom(__DIR__.'/resources/views', 'themes');

        // $this->loadMigrationsFrom(__DIR__.'/Database/migrations');

        $this->publishes([
            __DIR__ . '../public/js' => public_path('vendor/laravel-themes/js'),
        ], 'laravel-themes');
    }

    public function register()
    {

    }
}
?>