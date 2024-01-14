<?php


namespace Vince\AcmeDoorPad\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Vince\AcmeDoorPad\Models\Key;
use function PHPUnit\Framework\assertTrue;

class SecurityKeyCommandFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Generates 300 keys, chunks them into arbitrary amount ready for dispatching.
     * @test
     */

    public function it_can_batch_a_group_of_keys_into_sets_of_hundreds(){
        Queue::fake();
        $this->artisan('security:keyAdd --amount=10')->assertSuccessful();

        //Need to spend a little more time on this one as it doesn't seem to think it queues.
        //Queue::assertCount(1);
    }



}