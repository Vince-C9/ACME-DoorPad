<?php


namespace Vince\AcmeDoorPad\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Vince\AcmeDoorPad\Models\Key;
use Vince\AcmeDoorPad\Models\KeypadUser;

class KeyModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Determines whether the user model the key model can assign a user a key.
     * @test
     */
    public function it_can_assign_a_key_to_a_user(){
        //Set up a user with a key
        $user = factory(KeypadUser::class)->create();
        $key = factory(Key::class)->create();

        $key->assignKey($user->id, $key->key);
        $this->assertTrue(KeypadUser::first()->key->key === $key->key);
    }


    /**
     * Determines whether the user remove the key from a user..
     * @test
     */
    public function it_can_strip_a_key_from_a_user(){
        //Set up a user with a key
        $user = factory(KeypadUser::class)->create();
        $key = factory(Key::class)->create();
        $key->assignKey($user->id, $key->key);
        //Make sure the key is assigned.
        $this->assertTrue(KeypadUser::first()->key->key === $key->key);

        //Now strip it
        $key->stripKey($user->id);

        //Make sure it's gone!
        $this->assertTrue(is_null(KeypadUser::first()->key));
    }


}