<?php


namespace Vince\AcmeDoorPad\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Vince\AcmeDoorPad\Models\Key;
use Vince\AcmeDoorPad\Models\KeypadUser;

class AssociateKeyWithUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * It can associate a key with a user.
     * @test
     */

    public function it_can_associate_a_key_with_a_user(){
        $user = factory(KeypadUser::class)->create();
        $key = factory(Key::class)->create();

        //Command runs with now errors
        $this->artisan('security:associate', ['user_id'=>$user->id,'key'=>$key->key])->assertSuccessful();

        //Users key is the generated key passed into the command.
        $this->assertTrue(KeypadUser::find($user->id)->fresh()->key->key === $key->key);
    }

    /**
     * It can't associate a key with the user if a key already exists, but doesn't throw a hard error.
     * @test
     */

    public function it_cannot_associate_a_key_if_the_provided_user_already_has_one(){
        $user = factory(KeypadUser::class)->create();
        $key = factory(Key::class)->create();
        $user->key()->save($key);

        //Let's grab a new key for the fun of it.
        $newKey = factory(Key::class)->create();

        //Command runs with now errors
        $this->artisan('security:associate', ['user_id'=>$user->id,'key'=>$newKey->key])
            ->assertSuccessful()
            ->expectsOutput("User already has a key assigned to them.");

        //Users key is the generated key passed into the command.
        $this->assertFalse(KeypadUser::find($user->id)->key->key === $newKey->key);
    }

    /**
     * It can't associate a key that's not in the database.
     * @test
     */

    public function it_cannot_associate_a_key_that_isnt_in_the_database(){
        $user = factory(KeypadUser::class)->create();
        $key = 153287;

        //Command runs with now errors
        $this->artisan('security:associate', ['user_id'=>$user->id,'key'=>$key])
            ->assertSuccessful()
            ->expectsOutput("This key doesn't exist in the database.");

        //Users key is the generated key passed into the command.
        $this->assertTrue(is_null(KeypadUser::find($user->id)->key));

    }

}