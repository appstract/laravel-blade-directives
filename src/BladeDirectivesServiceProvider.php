<?php

namespace Appstract\BladeDirectives;

use Illuminate\Support\ServiceProvider;

class BladeDirectivesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->registerDirectives();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }

    /**
     * Register all directives.
     *
     * @return void
     */
    public function registerDirectives()
    {
        $directives = require __DIR__.'/directives.php';

        DirectivesRepository::register($directives);
    }
}
