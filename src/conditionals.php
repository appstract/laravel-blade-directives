<?php

use Appstract\BladeDirectives\DirectivesRepository;

return [

    /*
    |---------------------------------------------------------------------
    | @istrue / @isfalse
    |---------------------------------------------------------------------
    */

    'istrue' => function ($expression) {
        return isset($expression) && (bool) $expression === true;
    },

    'isfalse' => function ($expression) {
        return isset($expression) && (bool) $expression === false;
    },

    /*
    |---------------------------------------------------------------------
    | @routeis
    |---------------------------------------------------------------------
    */

    'routeis' => function ($expression) {
        return fnmatch($expression, Route::currentRouteName());
    },

    'routeisnot' => function ($expression) {
        return ! fnmatch($expression, Route::currentRouteName());
    },

    /*
    |---------------------------------------------------------------------
    | @instanceof
    |---------------------------------------------------------------------
    */

    'instanceof' => function ($expression) {
        list($class1, $class2) = DirectivesRepository::parseMultipleArgs($expression);

        return (bool) $class1 instanceof $class2;
    },

    /*
    |---------------------------------------------------------------------
    | @typeof
    |---------------------------------------------------------------------
    */

    'typeof' => function ($expression) {
        $expression = DirectivesRepository::parseMultipleArgs($expression);

        return gettype($expression->get(0)) == $expression->get(1);
    },

];
