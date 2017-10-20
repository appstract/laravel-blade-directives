<?php

namespace Appstract\BladeDirectives;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class BladeDirectivesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/blade-directives.php' => config_path('blade-directives.php'),
            ], 'config');
        }

        $this->registerDirectives();
        $this->registerConditionals();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/blade-directives.php', 'blade-directives');
    }

    /**
     * Register all directives.
     *
     * @return void
     */
    public function registerDirectives()
    {
        $directives = require __DIR__.'/directives.php';

        $directives = array_merge(
            $directives,
            Config::get('blade-directives.directives')
        );

        DirectivesRepository::directive($directives);
    }

    /**
     * Register all conditionals.
     *
     * @return void
     */
    public function registerConditionals()
    {
        $conditionals = require __DIR__.'/conditionals.php';

        $conditionals = array_merge(
            $directives,
            Config::get('blade-directives.conditionals')
        );

        DirectivesRepository::conditional($conditionals);
    }
}
