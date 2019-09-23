<?php

use Illuminate\Support\Str;
use Appstract\BladeDirectives\DirectivesRepository;

return [

    /*
    |---------------------------------------------------------------------
    | @istrue / @isfalse
    |---------------------------------------------------------------------
    */

    'istrue' => function ($expression) {
        if (Str::contains($expression, ',')) {
            $expression = DirectivesRepository::parseMultipleArgs($expression);

            return  "<?php if (isset({$expression->get(0)}) && (bool) {$expression->get(0)} === true) : ?>".
                    "<?php echo {$expression->get(1)}; ?>".
                    '<?php endif; ?>';
        }

        return "<?php if (isset({$expression}) && (bool) {$expression} === true) : ?>";
    },

    'endistrue' => function ($expression) {
        return '<?php endif; ?>';
    },

    'isfalse' => function ($expression) {
        if (Str::contains($expression, ',')) {
            $expression = DirectivesRepository::parseMultipleArgs($expression);

            return  "<?php if (isset({$expression->get(0)}) && (bool) {$expression->get(0)} === false) : ?>".
                    "<?php echo {$expression->get(1)}; ?>".
                    '<?php endif; ?>';
        }

        return "<?php if (isset({$expression}) && (bool) {$expression} === false) : ?>";
    },

    'endisfalse' => function ($expression) {
        return '<?php endif; ?>';
    },

    /*
    |---------------------------------------------------------------------
    | @isnull / @isnotnull
    |---------------------------------------------------------------------
    */

    'isnull' => function ($expression) {
        return "<?php if (is_null({$expression})) : ?>";
    },

    'endisnull' => function ($expression) {
        return '<?php endif; ?>';
    },

    'isnotnull' => function ($expression) {
        return "<?php if (! is_null({$expression})) : ?>";
    },

    'endisnotnull' => function ($expression) {
        return '<?php endif; ?>';
    },

    /*
    |---------------------------------------------------------------------
    | @mix
    |---------------------------------------------------------------------
    */

    'mix' => function ($expression) {
        if (ends_with($expression, ".css'")) {
            return '<link rel="stylesheet" href="<?php echo mix('.$expression.') ?>">';
        }

        if (ends_with($expression, ".js'")) {
            return '<script src="<?php echo mix('.$expression.') ?>"></script>';
        }

        return "<?php echo mix({$expression}); ?>";
    },

    /*
    |---------------------------------------------------------------------
    | @style
    |---------------------------------------------------------------------
    */

    'style' => function ($expression) {
        if (! empty($expression)) {
            return '<link rel="stylesheet" href="'.DirectivesRepository::stripQuotes($expression).'">';
        }

        return '<style>';
    },

    'endstyle' => function () {
        return '</style>';
    },

    /*
    |---------------------------------------------------------------------
    | @script
    |---------------------------------------------------------------------
    */

    'script' => function ($expression, $defer = null) {
        if (! empty($expression)) {
            [$src, $defer] = explode(',', str_replace(['(', ')', ' '], '', $expression));

            return '<script src="'.DirectivesRepository::stripQuotes($src).'"'.$defer.'></script>';
        }

        return '<script>';
    },

    'endscript' => function () {
        return '</script>';
    },

    /*
    |---------------------------------------------------------------------
    | @js
    |---------------------------------------------------------------------
    */

    'js' => function ($expression) {
        $expression = DirectivesRepository::parseMultipleArgs($expression);

        $variable = DirectivesRepository::stripQuotes($expression->get(0));

        return  "<script>\n".
                "window.{$variable} = <?php echo is_array({$expression->get(1)}) ? json_encode({$expression->get(1)}) : '\''.{$expression->get(1)}.'\''; ?>;\n".
                '</script>';
    },

    /*
    |---------------------------------------------------------------------
    | @inline
    |---------------------------------------------------------------------
    */

    'inline' => function ($expression) {
        $include = "/* {$expression} */\n".
                   "<?php include public_path({$expression}) ?>\n";

        if (ends_with($expression, ".html'")) {
            return $include;
        }

        if (ends_with($expression, ".css'")) {
            return "<style>\n".$include.'</style>';
        }

        if (ends_with($expression, ".js'")) {
            return "<script>\n".$include.'</script>';
        }
    },

    /*
    |---------------------------------------------------------------------
    | @routeis
    |---------------------------------------------------------------------
    */

    'routeis' => function ($expression) {
        return "<?php if (fnmatch({$expression}, Route::currentRouteName())) : ?>";
    },

    'endrouteis' => function ($expression) {
        return '<?php endif; ?>';
    },

    'routeisnot' => function ($expression) {
        return "<?php if (! fnmatch({$expression}, Route::currentRouteName())) : ?>";
    },

    'endrouteisnot' => function ($expression) {
        return '<?php endif; ?>';
    },

    /*
    |---------------------------------------------------------------------
    | @instanceof
    |---------------------------------------------------------------------
    */

    'instanceof' => function ($expression) {
        $expression = DirectivesRepository::parseMultipleArgs($expression);

        return  "<?php if ({$expression->get(0)} instanceof {$expression->get(1)}) : ?>";
    },

    'endinstanceof' => function () {
        return '<?php endif; ?>';
    },

    /*
    |---------------------------------------------------------------------
    | @typeof
    |---------------------------------------------------------------------
    */

    'typeof' => function ($expression) {
        $expression = DirectivesRepository::parseMultipleArgs($expression);

        return  "<?php if (gettype({$expression->get(0)}) == {$expression->get(1)}) : ?>";
    },

    'endtypeof' => function () {
        return '<?php endif; ?>';
    },

    /*
    |---------------------------------------------------------------------
    | @dump, @dd
    |---------------------------------------------------------------------
    */

    'dump' => function ($expression) {
        return "<?php dump({$expression}); ?>";
    },

    'dd' => function ($expression) {
        return "<?php dd({$expression}); ?>";
    },

    /*
    |---------------------------------------------------------------------
    | @pushonce
    |---------------------------------------------------------------------
    */

    'pushonce' => function ($expression) {
        [$pushName, $pushSub] = explode(':', trim(substr($expression, 1, -1)));

        $key = '__pushonce_'.str_replace('-', '_', $pushName).'_'.str_replace('-', '_', $pushSub);

        return "<?php if(! isset(\$__env->{$key})): \$__env->{$key} = 1; \$__env->startPush('{$pushName}'); ?>";
    },

    'endpushonce' => function () {
        return '<?php $__env->stopPush(); endif; ?>';
    },

    /*
    |---------------------------------------------------------------------
    | @repeat
    |---------------------------------------------------------------------
    */

    'repeat' => function ($expression) {
        return "<?php for (\$iteration = 0 ; \$iteration < (int) {$expression}; \$iteration++): ?>";
    },

    'endrepeat' => function ($expression) {
        return '<?php endfor; ?>';
    },

    /*
     |---------------------------------------------------------------------
     | @data
     |---------------------------------------------------------------------
     */

    'data' => function ($expression) {
        $output = 'collect((array) '.$expression.')
            ->map(function($value, $key) {
                return "data-{$key}=\"{$value}\"";
            })
            ->implode(" ")';

        return "<?php echo $output; ?>";
    },

    /*
    |---------------------------------------------------------------------
    | @fa, @fas, @far, @fal, @fab, @mdi, @glyph
    |---------------------------------------------------------------------
    */

    'fa' => function ($expression) {
        $expression = DirectivesRepository::parseMultipleArgs($expression);

        return '<i class="fa fa-'.DirectivesRepository::stripQuotes($expression->get(0)).' '.DirectivesRepository::stripQuotes($expression->get(1)).'"></i>';
    },

    'fas' => function ($expression) {
        $expression = DirectivesRepository::parseMultipleArgs($expression);

        return '<i class="fas fa-'.DirectivesRepository::stripQuotes($expression->get(0)).' '.DirectivesRepository::stripQuotes($expression->get(1)).'"></i>';
    },

    'far' => function ($expression) {
        $expression = DirectivesRepository::parseMultipleArgs($expression);

        return '<i class="far fa-'.DirectivesRepository::stripQuotes($expression->get(0)).' '.DirectivesRepository::stripQuotes($expression->get(1)).'"></i>';
    },

    'fal' => function ($expression) {
        $expression = DirectivesRepository::parseMultipleArgs($expression);

        return '<i class="fal fa-'.DirectivesRepository::stripQuotes($expression->get(0)).' '.DirectivesRepository::stripQuotes($expression->get(1)).'"></i>';
    },

    'fab' => function ($expression) {
        $expression = DirectivesRepository::parseMultipleArgs($expression);

        return '<i class="fab fa-'.DirectivesRepository::stripQuotes($expression->get(0)).' '.DirectivesRepository::stripQuotes($expression->get(1)).'"></i>';
    },

    'mdi' => function ($expression) {
        $expression = DirectivesRepository::parseMultipleArgs($expression);

        return '<i class="mdi mdi-'.DirectivesRepository::stripQuotes($expression->get(0)).' '.DirectivesRepository::stripQuotes($expression->get(1)).'"></i>';
    },

    'glyph' => function ($expression) {
        $expression = DirectivesRepository::parseMultipleArgs($expression);

        return '<i class="glyphicons glyphicons-'.DirectivesRepository::stripQuotes($expression->get(0)).' '.DirectivesRepository::stripQuotes($expression->get(1)).'"></i>';
    },

    /*
    |---------------------------------------------------------------------
    | @haserror
    |---------------------------------------------------------------------
    */

    'haserror' => function ($expression) {
        return '<?php if (isset($errors) && $errors->has('.$expression.')): ?>';
    },

    'endhaserror' => function () {
        return '<?php endif; ?>';
    },

];
