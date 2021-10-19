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
			__DIR__ . '/../public' => public_path('vendor/laravel-themes'),
		], 'laravel-themes');
	}

	public function register()
	{

	}
}
?>