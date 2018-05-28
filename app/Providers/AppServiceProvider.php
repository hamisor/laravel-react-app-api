<?php

namespace App\Providers;

// Hamisor
use App\BusinessLogic\SiteDataProvider;
// Lumen
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/** @var bool */
	protected $defer = true;

	/**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    	/** @var array $dbConfig */
		$dbConfig = config('database.connections.mongodb');
		$this->app->singleton(SiteDataProvider::class, function() use($dbConfig) {
			return new SiteDataProvider($dbConfig);
		});
    }

	public function provides()
	{
		return [
			ServiceProvider::class
		];
	}
}

