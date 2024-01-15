<?php


namespace Vince\AcmeDoorPad\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Vince\AcmeDoorPad\Models\Key;
use Vince\AcmeDoorPad\Models\KeypadUser;
use Vince\AcmeDoorPad\Services\KeyCodes\KeyCodeService;

class KeyUserRelationshipTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Creates a new user, creates a new key, then assigns the key to the user.
     * Grabs a fresh instance of the user from the database and makes sure that the key value has stored as expected.
     * @test
     */

    public function it_can_attach_a_key_to_a_user_and_recall_the_key_with_said_user(){
        $user = factory(KeypadUser::class)->create();
        $key = factory(Key::class)->create();
        $user->key()->save($key);

        //Grab a new user variant to be sure we're not caching anything
        $this->assertTrue(KeypadUser::first()->key->key === $key->key);
    }


    /**
     * Creates a user and a key, assigns them, then strips them and makes sure the key is gone!
     * @test
     */
    public function it_can_remove_a_key_from_the_one_to_one_relationship(){
        $user = factory(KeypadUser::class)->create();
        $key = factory(Key::class)->create();
        $user->key()->save($key);

        //Grab a new user variant to be sure we're not caching anything
        $this->assertTrue(KeypadUser::first()->key->key === $key->key);

        //There is almost certainly a better way to do this but it escapes me.
        $user->key->keypad_user_id = null;
        $user->key->save();

        $this->assertTrue(is_null($user->key->keypad_user_id));
        $this->assertTrue(KeypadUser::count()==1 && Key::count() ==1);
    }


}