<?php


namespace Vince\AcmeDoorPad\Console;


use Illuminate\Console\Command;
use PHPUnit\Event\Runtime\PHPUnit;
use Throwable;
use Vince\AcmeDoorPad\Models\Key;
use Vince\AcmeDoorPad\Models\KeypadUser;

class DissociateKeyWithUser extends Command
{
    protected $signature = "security:dissociateKey {user_id}";
    protected $description = "Strips a users key from them.";

    public function handle(){
        $user = $this->argument('user_id');

        try {
            //If I have a key, strip it from me.
            if(KeypadUser::hasKeyAssigned($user)){
                $r=Key::stripKey($user);
                $this->info("Command Complete. See below");
                $u = KeypadUser::find($user);
                $this->info("The user ".$u->name." ".$u->surname." has been stripped of their key.");
            }else{
                $this->info("User does not have a key assigned to them.");
            }
            return 0;
        }catch (Throwable $t){
            report($t);
            $this->info($t->getMessage());
            return 1;
        }
    }
}