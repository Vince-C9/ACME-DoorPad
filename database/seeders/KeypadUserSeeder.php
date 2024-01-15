<?php


namespace Vince\AcmeDoorPad\Database\Seeders;


use Illuminate\Database\Seeder;
use Vince\AcmeDoorPad\Models\Key;
use Vince\AcmeDoorPad\Models\KeypadUser;

class KeypadUserSeeder extends Seeder
{
    public function run():void{
        //Generate Some Users
        factory(KeypadUser::class, 10)->create()->each(function($user){
            $key = factory(Key::class)->create();
            $user->key()->save($key);
        });
    }
}