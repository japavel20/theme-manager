<?php

namespace ThemeManager;

use Illuminate\Support\ServiceProvider;

class ThemeManagerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish the configuration and public assets
        $this->publishes([
            __DIR__ . '/../config/theme.php' => config_path('theme.php'),
        ], 'config'); // Correct the tag to 'config' for configuration

        $this->publishes([
            __DIR__ . '/../public/themes' => public_path('themes'),
        ], 'public'); // Correct the tag to 'public' for assets

        $this->publishes([
            __DIR__ . '/../public/global_assets' => public_path('themes/global_assets'),
        ], 'public'); // Correct the tag to 'public' for assets

        $this->publishes([
            __DIR__ . '/../stubs/App' => app_path('/')
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Merge the configuration file if it exists
        $this->mergeConfigFrom(__DIR__ . '/../config/theme.php', 'theme');

        // Register the Theme class as a singleton
        $this->app->singleton('theme', function () {
            return new Theme();
        });

        // Load the helper file
        $helpersPath = __DIR__ . '/helpers.php';
        if (file_exists($helpersPath)) {
            require_once $helpersPath;
        }
    }
}
