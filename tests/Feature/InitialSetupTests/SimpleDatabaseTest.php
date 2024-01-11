<?php


namespace Vince\AcmeDoorPad\Tests;



use Illuminate\Foundation\Testing\RefreshDatabase;
use Vince\AcmeDoorPad\Models\Key;

/**
 * Class SimpleInstantiationTest
 * @package Vince\AcmeDoorPad\Tests\Feature
 *
 * Make sure migrations run and tests can save to the in memory database
 */
class SimpleDatabaseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_save_a_key_to_the_database_using_a_factory(){
        $key = factory(Key::class)->create();
        $this->assertCount(1, Key::all());
        $this->assertTrue(Key::first()->key === $key->key);
    }

}