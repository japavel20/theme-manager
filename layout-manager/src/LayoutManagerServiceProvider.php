<?php

namespace Layout\Manager;

use Illuminate\Support\ServiceProvider;

class LayoutManagerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load views
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'layout');
        $this->layouts();
        
        

        
    }

    public function layouts(){
        // Register Blade components
        \Illuminate\Support\Facades\Blade::component('theme-master', \Layout\Manager\App\View\Components\Layouts\Master::class);
    }
}
