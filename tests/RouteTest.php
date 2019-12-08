<?php

namespace Appstract\BladeDirectives\Test;

class RouteTest extends TestCase
{
    public function test_routeis_is_compiled()
    {
        $this->withoutExceptionHandling();

        $this->get(route('webshop.checkout'))
            ->assertSee('Do something only on the checkout');
    }

    public function test_routeisnot_is_compiled()
    {
        $this->withoutExceptionHandling();

        $this->get('not-checkout')
            ->assertSee('Do something only if this is not the checkout');
    }
}
