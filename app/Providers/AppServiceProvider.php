<?php declare(strict_types=1);

namespace App\Providers;

use Barryvdh\Debugbar\Facade;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Force SSL in production
        if ($this->app->environment() == 'production') {
            //URL::forceScheme('https');
        }

        // Set the default string length for Laravel5.4
        // https://laravel-news.com/laravel-5-4-key-too-long-error
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /*
         * Sets third party service providers that are only needed on local/testing environments
         */
        if ($this->app->environment() !== 'production') {
            /**
             * Loader for registering facades.
             */
            $loader = AliasLoader::getInstance();

            /*
             * Load third party local providers
             */
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            $this->app->register(IdeHelperServiceProvider::class);

            /*
             * Load third party local aliases
             */
            $loader->alias('Debugbar', Facade::class);
        }
    }
}
