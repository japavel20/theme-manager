<?php

use Illuminate\Support\Facades\App;

if (!function_exists('theme')) {
    /**
     * Get the Theme instance from the service container.
     *
     * @return \ThemeManager\Theme
     */
    function theme()
    {
        return App::make('theme');
    }
}

