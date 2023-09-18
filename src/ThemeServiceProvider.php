<?php
namespace Codificar\Themes;
use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider {

	public function boot()
	{
		$this->loadRoutesFrom(__DIR__.'/routes/web.php');

		$this->loadViewsFrom(__DIR__.'/resources/views', 'themes');
		
        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');

		$this->loadTranslationsFrom(__DIR__ . '/translations', 'themes');

		$this->publishes([
			__DIR__ . '/../public' => public_path('vendor/codificar/laravel-themes'),
		], 'laravel-themes');

        // Publish the tests files 
        $this->publishes([
            __DIR__ . '/../tests/' => base_path('tests/Unit/libs/themes'),
        ], 'publishes_tests');
	}

	public function register()
	{

	}
}
?>