<?php

namespace Appstract\BladeDirectives;

use Illuminate\Support\Facades\Blade;

class DirectivesRepository
{
    /**
     * @var array
     */
    protected static $views_registry = [];

    /**
     * Register the directives.
     *
     * @param  array $directives
     * @return void
     */
    public static function register(array $directives)
    {
        collect($directives)->each(function ($item, $key) {
            Blade::directive($key, $item);
        });
    }

    /**
     * Parse expression.
     *
     * @param  string $expression
     * @return \Illuminate\Support\Collection
     */
    public static function parseMultipleArgs($expression)
    {
        return collect(explode(',', $expression))->map(function ($item) {
            return trim($item);
        });
    }

    /**
     * Strip quotes.
     *
     * @param  string $expression
     * @return string
     */
    public static function stripQuotes($expression)
    {
        return str_replace(["'", '"'], '', $expression);
    }

    /**
     * Check if a view has not been included yet.
     * @param string $view
     *
     * @return bool
     */
    public static function viewWasNotIncluded($view)
    {
        return ! in_array($view, static::$views_registry);
    }

    /**
     * @param string $view
     */
    public static function addIncludedView($view)
    {
        static::$views_registry[] = $view;
    }
}
