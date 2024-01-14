<?php


namespace Vince\AcmeDoorPad\Console;


use Illuminate\Console\Command;
use Vince\AcmeDoorPad\Jobs\QueueAdditionalKeys;
use Vince\AcmeDoorPad\Services\KeyCodes\KeyCodeService;

class SecurityKeyCommand extends Command
{
    protected $signature = "security:keyAdd {--amount=1}";
    protected $description = "Adds a security key to the database.";

    public function handle(){
        $keyService = new KeyCodeService();
        $amount = $this->option('amount') > 0 ? $this->option('amount') : 1;
        $keys=[];
        for($i=0; $i < $amount; $i++ ){
            $keys[] = $keyService->generateUniqueKey();
        }

        $keys=array_chunk($keys, 100, true);
        foreach($keys as $batch){
            QueueAdditionalKeys::dispatch($batch);
        }

    }
}