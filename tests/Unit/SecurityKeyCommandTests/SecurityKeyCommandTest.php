<?php


namespace Vince\AcmeDoorPad\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Vince\AcmeDoorPad\Services\KeyCodes\KeyCodeService;

class SecurityKeyCommandTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Generates 300 keys, chunks them into arbitrary amount ready for dispatching.
     * @test
     */

    public function it_can_batch_a_group_of_keys_into_sets_of_hundreds(){
        $keyService = new KeyCodeService();
        $keys=[];

        for($i=0; $i<300; $i++){
            $keys[] = $keyService->generateUniqueKey();
        };

        $keys=array_chunk($keys, 100, true);
        $this->assertTrue(count($keys)==3);
        $this->assertTrue(count($keys[0])==100);
    }



}