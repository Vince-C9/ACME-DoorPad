<?php

namespace  Vince\AcmeDoorPad\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Vince\AcmeDoorPad\Models\Key;

class QueueAdditionalKeys implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public $keys;

    public function __construct($keys){
        $this->keys = $keys;
    }


    /**
     * We'll use this job to process chunks of key creation asynchronously.  This way we offload
     * the process onto a different thread and don't cause lag on the main process.
     */
    public function handle(): void{
        foreach($this->keys as $key){
            Key::create([
                'key'=>$key
            ]);
        }
    }
}
