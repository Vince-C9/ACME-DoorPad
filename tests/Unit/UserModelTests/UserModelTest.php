<?php


namespace Vince\AcmeDoorPad\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Vince\AcmeDoorPad\Models\Key;
use Vince\AcmeDoorPad\Models\KeypadUser;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Determines whether the user model can tell if a particular user has a key assigned.
     * @test
     */
    public function it_can_rapidly_determine_if_a_user_has_an_associated_key(){
        //Set up a user with a key
       $user = factory(KeypadUser::class)->create();
       $key = factory(Key::class)->create();
       $user->key()->save($key);
       $this->assertTrue($user->hasKeyAssigned($user->id));
    }


}