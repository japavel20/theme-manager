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
        $this->libs();
        
        

        
    }

    public function layouts(){
        // Register Blade components
        \Illuminate\Support\Facades\Blade::component('theme-master', \Layout\Manager\App\View\Components\Layouts\Master::class);
    }
    private function libs(){
        \Illuminate\Support\Facades\Blade::component('style',\Layout\Manager\App\View\Components\Layouts\Libs\Style::class);
        \Illuminate\Support\Facades\Blade::component('js',\Layout\Manager\App\View\Components\Layouts\Libs\Js::class);
    }
    
}

