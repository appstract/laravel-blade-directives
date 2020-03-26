<?php

namespace Appstract\BladeDirectives\Test;

class ErrorTest extends TestCase
{
    /** @test */
    public function true()
    {
        return $this->assertTrue(true);
    }

    public function _test_has_errors_is_compiled()
    {
        // Without errors var
        $this->assertBlade(
            'Input: Has not errors',
            'Input:@haserror($errors->has(\'input_name\')) This input has an error @endhaserror Has not errors'
        );

        $errors = "new \Illuminate\Support\MessageBag(['input_name' => 1])";

        // With errors var
        $this->assertBlade(
            'Input: This input has an error',
            'Input:@haserror("input_name") This input has an error @endhaserror',
            [
                'errors' => $errors,
            ]
        );
    }
}
