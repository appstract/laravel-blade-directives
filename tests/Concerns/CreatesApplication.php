<?php

namespace Appstract\BladeDirectives\Test\Concerns;

use Illuminate\Support\Facades\View;

trait CreatesApplication
{
    protected function getPackageProviders($app)
    {
        return [
            \Appstract\BladeDirectives\BladeDirectivesServiceProvider::class,
            \Appstract\BladeDirectives\Test\App\Providers\RouteServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app->setBasePath(__DIR__.'/../laravel');
        View::addLocation(resource_path('views'));
    }
}
