<?php

namespace Mr687\ZoomMeeting\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Mr687\ZoomMeeting\Classes\ZoomMeeting;
use Mr687\ZoomMeeting\Classes\ZoomUser;

class ZoomMeetingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/zoom.php', 'zoom');

        $this->publishConfig();

        // $this->loadViewsFrom(__DIR__.'/resources/views', 'zoom-meeting');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->registerRoutes();
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        });
    }

    /**
     * Get route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration()
    {
        return [
            'namespace'  => "Mr687\ZoomMeeting\Http\Controllers",
            'middleware' => 'api',
            'prefix'     => 'api'
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register facade
        $this->app->singleton('zoom-meeting', function () {
            return new ZoomMeeting;
        });

        $this->app->singleton('zoom-user', function () {
            return new ZoomUser;
        });
    }

    /**
     * Publish Config
     *
     * @return void
     */
    public function publishConfig()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/zoom.php' => config_path('zoom.php'),
            ], 'config');
        }
    }
}
