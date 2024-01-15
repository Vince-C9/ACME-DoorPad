<?php


namespace Vince\AcmeDoorPad\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Vince\AcmeDoorPad\Models\Key;
use Vince\AcmeDoorPad\Models\KeypadUser;

class DissociateKeyWithUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * It strips the key from the user.
     * @test
     */

    public function it_can_dissociate_a_key_from_a_user(){

        //Make and associate a key with the user.
        $user = factory(KeypadUser::class)->create();
        $key = factory(Key::class)->create();
        $user->key()->save($key);

        //Make sure the key is assigned as expected.
        $this->assertTrue(KeypadUser::find($user->id)->key->key === $key->key);

        //Now strip it! :)
        $this->artisan('security:dissociateKey', ['user_id'=>$user->id])->assertSuccessful();

        $this->assertTrue(is_null(KeypadUser::find($user->id)->fresh()->key));
    }

    /**
     * It throws a clean message if there is no assigned key.
     * @test
     */
    public function it_cannot_associate_a_key_if_the_provided_user_doesnt_have_one(){
        //Make a user without a key.
        $user = factory(KeypadUser::class)->create();

        //Now strip it! :)
        $this->artisan('security:dissociateKey', ['user_id'=>$user->id])
            ->assertSuccessful()
            ->expectsOutput("User does not have a key assigned to them.");
    }
}