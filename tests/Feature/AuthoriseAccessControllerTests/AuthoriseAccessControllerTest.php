<?php


namespace Vince\AcmeDoorPad\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Vince\AcmeDoorPad\Models\Key;

class AuthoriseAccessControllerTest extends TestCase
{
    use RefreshDatabase;


    /**
     * @test
     */
    public function it_doesnt_allow_non_number_characters(){
        $response = $this->post(route('key_access.login'), [
            'key'=>'12ABC34'
        ]);

        $response->assertSessionHasErrors();
        $response->assertSessionHasErrors([
            'key'=>config('acme.door_key_errors.number')
        ]);
    }

    /**
     * @test
     */
    public function it_only_allows_integer_numbers(){
        $response = $this->post(route('key_access.login'), [
            'key'=>'123456.4'
        ]);

        $response->assertSessionHasErrors();
        $response->assertSessionHasErrors([
            'key'=>config('acme.door_key_errors.size')
        ]);
    }

    /**
     * @test
     */
    public function it_doesnt_allow_keys_less_than_six_digits(){
        $response = $this->post(route('key_access.login'), [
            'key'=>'123'
        ]);

        $response->assertSessionHasErrors();
        $response->assertSessionHasErrors([
            'key'=>config('acme.door_key_errors.size')
        ]);
    }

    /**
     * @test
     */
    public function it_doesnt_allow_keys_greater_than_six_digits(){
        $response = $this->post(route('key_access.login'), [
            'key'=>'1234567'
        ]);

        $response->assertSessionHasErrors();
        $response->assertSessionHasErrors([
            'key'=>config('acme.door_key_errors.size')
        ]);
    }

    /**
     * @test
     */
    public function it_doesnt_allow_blank_pins(){
        //No post data
        $response = $this->post(route('key_access.login'), []);

        $response->assertSessionHasErrors();
        $response->assertSessionHasErrors([
            'key'=>config('acme.door_key_errors.required')
        ]);

        //Empty post data
        $response = $this->post(route('key_access.login'), ['key'=>'']);

        $response->assertSessionHasErrors();
        $response->assertSessionHasErrors([
            'key'=>config('acme.door_key_errors.required')
        ]);
    }

    /**
     * @test
     */
    public function it_doesnt_allow_keys_that_match_the_rules_but_are_not_assigned_to_a_user(){
        
    }

    /**
     * @test
     */
    public function it_allows_a_user_with_a_valid_assigned_key_to_enter(){

    }
}