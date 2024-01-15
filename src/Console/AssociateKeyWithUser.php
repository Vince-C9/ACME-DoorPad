<?php


namespace Vince\AcmeDoorPad\Console;


use Illuminate\Console\Command;
use PHPUnit\Event\Code\Throwable;
use Vince\AcmeDoorPad\Models\Key;
use Vince\AcmeDoorPad\Models\KeypadUser;

class AssociateKeyWithUser extends Command
{
    protected $signature = "security:associate {user_id} {key}";
    protected $description = "Associates the provided key with the provided user.  Example: security:associate USER_ID KEY_ID";

    public function handle(){
        $key = $this->argument('key');
        $user = $this->argument('user_id');

        try{
            if(!KeypadUser::hasKeyAssigned($user)){
                if(Key::exists($key)){
                    Key::assignKey($user, $key);
                    $this->info("Command Complete. See below");
                    $u=KeypadUser::find($user);
                    $this->info("The user ".$u->name." ".$u->surname." has been associated with the key: ".$u->key->key);
                }else{
                    $this->info("This key doesn't exist in the database.");
                }

            }else{
                $this->info("User already has a key assigned to them.");
            }
            return 0;
        }catch(Throwable $t){
            report($t);
            $this->info($t->getMessage());
            return 1;
        }
    }
}