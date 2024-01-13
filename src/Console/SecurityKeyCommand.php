<?php


namespace Vince\AcmeDoorPad\Console;


use Illuminate\Console\Command;

class SecurityKeyCommand extends Command
{
    protected $signature = "security:keyAdd";
    protected $description = "Adds a security key to the database.";

    public function handle(){
        $this->info("Basic command seems to be working");
    }
}