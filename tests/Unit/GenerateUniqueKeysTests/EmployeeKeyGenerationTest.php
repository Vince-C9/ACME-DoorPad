<?php


namespace Vince\AcmeDoorPad\Tests\Unit\GenerateUniqueKeysTests;


use Orchestra\Testbench\TestCase;
use Vince\AcmeDoorPad\Services\KeyCodes\KeyCodeService;

class EmployeeKeyGenerationTest extends TestCase
{

    /**
     * The codes must not generate palindromes
     * EG: 123321
     * @test
     */
    public function it_does_not_generate_palindromes(){
        $keyService = new KeyCodeService;
        $key = $keyService->generateUniqueKey();
        $this->assertTrue($keyService->isNotPalindrome($key));
    }

    /**
     * It cannot generate a character with 4+ uses of the same value.
     * EG: 131411
     * @test
     */
    public function it_does_not_generate_keys_with_more_than_three_repeated_digits(){
        $keyService = new KeyCodeService;
        $key = $keyService->generateUniqueKey();
        $this->assertTrue($keyService->digitRepititionIsValid($key));
    }

    /**
     * It cannot create a sequence length greater than three.
     * EG: 123472
     * @test
     */
    public function it_cannot_generate_a_code_with_a_sequence_length_greater_than_three(){
        $keyService = new KeyCodeService;
        $key = $keyService->generateUniqueKey();
        $this->assertTrue($keyService->digitSequenceIsValid($key));
    }


    /**
     * It shouldn't generate a code that is not unique
     * @test
     */
    public function it_can_only_generate_a_unique_code(){
        $keyService = new KeyCodeService;
        $key = $keyService->generateUniqueKey();
        $this->assertDatabaseMissing('keys', ['key'=>$key]);
    }

    /**
     * It shouldn't generate a code above the specified / configured character length (6, but should be extensible)
     * @test
     */
    public function it_can_only_generate_codes_of_the_specified_character_length(){
        $keyService = new KeyCodeService;
        $key = $keyService->generateUniqueKey();
        $this->assertTrue(strlen($key)==6);
    }


}