<?php

namespace Appstract\BladeDirectives\Test;

class IconsTest extends TestCase
{
    public function test_fa_is_compiled()
    {
        $blade = "@fa('address-book', 'optional-extra-class')";
        $expected = '<i class="fa fa-address-book optional-extra-class"></i>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_fas_is_compiled()
    {
        $blade = "@fas('address-book', 'optional-extra-class')";
        $expected = '<i class="fas fa-address-book optional-extra-class"></i>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_far_is_compiled()
    {
        $blade = "@far('address-book', 'optional-extra-class')";
        $expected = '<i class="far fa-address-book optional-extra-class"></i>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_fal_is_compiled()
    {
        $blade = "@fal('address-book', 'optional-extra-class')";
        $expected = '<i class="fal fa-address-book optional-extra-class"></i>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_fab_is_compiled()
    {
        $blade = "@fab('address-book', 'optional-extra-class')";
        $expected = '<i class="fab fa-address-book optional-extra-class"></i>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_mdi_is_compiled()
    {
        $blade = "@mdi('account', 'optional-extra-class')";
        $expected = '<i class="mdi mdi-account optional-extra-class"></i>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_glyph_is_compiled()
    {
        $blade = "@glyph('glass', 'optional-extra-class')";
        $expected = '<i class="glyphicons glyphicons-glass optional-extra-class"></i>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }

    public function test_bi_is_compiled()
    {
        $blade = "@bi('at', 'optional-extra-class')";
        $expected = '<i class="bi bi-at optional-extra-class"></i>';

        $this->assertSame($expected, $this->blade->compileString($blade));
    }
}
