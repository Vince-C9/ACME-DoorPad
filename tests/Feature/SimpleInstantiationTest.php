<?php


namespace Vince\AcmeDoorPad\Tests\Feature;


use Orchestra\Testbench\TestCase;

/**
 * Class SimpleInstantiationTest
 * @package Vince\AcmeDoorPad\Tests\Feature
 *
 * One or two initial tests just to make sure the config is set up as expected.
 */
class SimpleInstantiationTest extends TestCase
{
    /** @test */
    public function it_can_run_a_simple_test(){
        $this->assertTrue(true);
    }

    /** @test */
    public function it_can_see_that_false_is_not_true(){
        $this->assertTrue(false != true);
    }
}