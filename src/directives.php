<?php

use Appstract\BladeDirectives\DirectivesRepository;

return [

    /*
    |--------------------------------------------------------------------------
    | @istrue
    |--------------------------------------------------------------------------
    */

    'istrue' => function ($expression) {
        if (str_contains($expression, ',')) {
            $expression = DirectivesRepository::parseExpression($expression);

            return  "<?php if (isset({$expression->get(0)}) && (bool) {$expression->get(0)} === true) : ?>".
                    "<?php echo {$expression->get(1)}; ?>".
                    '<?php endif; ?>';
        }

        return "<?php if (isset({$expression}) && (bool) {$expression} === true) : ?>";
    },

    'endistrue' => function ($expression) {
        return '<?php endif; ?>';
    },

    /*
    |--------------------------------------------------------------------------
    | @mix
    |--------------------------------------------------------------------------
    */

    'mix' => function ($expression) {
        if (ends_with($expression, ".css'")) {
            return '<link rel="stylesheet" href="<?php echo mix('.$expression.') ?>">';
        } elseif (ends_with($expression, ".js'")) {
            return '<script src="<?php echo mix('.$expression.') ?>"></script>';
        }

        return "<?php echo mix({$expression}); ?>";
    },

    /*
    |--------------------------------------------------------------------------
    | @style
    |--------------------------------------------------------------------------
    */

    'style' => function ($expression) {
        if (! empty($expression)) {
            return '<link rel="stylesheet" href="'.str_replace("'", '', $expression).'">';
        }

        return '<style>';
    },

    'endstyle' => function () {
        return '</style>';
    },

    /*
    |--------------------------------------------------------------------------
    | @script
    |--------------------------------------------------------------------------
    */

    'script' => function ($expression) {
        if (! empty($expression)) {
            return '<script src="'.str_replace("'", '', $expression).'"></script>';
        }

        return '<script>';
    },

    'endscript' => function () {
        return '</script>';
    },

    /*
    |--------------------------------------------------------------------------
    | @instanceof
    |--------------------------------------------------------------------------
    */

    'instanceof' => function ($expression) {
        $expression = DirectivesRepository::parseExpression($expression);

        return  "<?php if ({$expression->get(0)} instanceof {$expression->get(1)}) : ?>";
    },

    'endinstanceof' => function () {
        return '<?php endif; ?>';
    },

    /*
    |--------------------------------------------------------------------------
    | @typeof
    |--------------------------------------------------------------------------
    */

    'typeof' => function ($expression) {
        $expression = DirectivesRepository::parseExpression($expression);

        return  "<?php if (gettype({$expression->get(0)}) == {$expression->get(1)}) : ?>";
    },

    'endtypeof' => function () {
        return '<?php endif; ?>';
    },

    /*
    |--------------------------------------------------------------------------
    | @dump, @dd
    |--------------------------------------------------------------------------
    */

    'dump' => function ($expression) {
        return "<?php dump({$expression}); ?>";
    },

    'dd' => function ($expression) {
        return "<?php dd({$expression}); ?>";
    },

];
