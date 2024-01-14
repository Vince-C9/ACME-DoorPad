<?php


namespace Vince\AcmeDoorPad\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Vince\AcmeDoorPad\Models\Key;
use function PHPUnit\Framework\assertTrue;

class AuthoriseAccessControllerTest extends TestCase
{
    use RefreshDatabase;


    /**
     * @test
     */
    public function it_doesnt_allow_non_number_characters(){

    }

    /**
     * @test
     */
    public function it_only_allows_integer_numbers(){

    }

    /**
     * @test
     */
    public function it_doesnt_allow_keys_less_than_six_digits(){

    }

    /**
     * @test
     */
    public function it_doesnt_allow_keys_greater_than_six_digits(){

    }

    /**
     * @test
     */
    public function it_doesnt_allow_keys_that_dont_exist_in_the_database(){

    }

    /**
     * @test
     */
    public function it_doesnt_allow_blank_pins(){

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