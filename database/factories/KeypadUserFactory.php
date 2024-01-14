<?php

use Vince\AcmeDoorPad\Models\KeypadUser;
use Vince\AcmeDoorPad\Services\KeyCodes\KeyCodeService;



$factory->define(KeypadUser::class, function(Faker\Generator $faker){
    $keyService = new KeyCodeService;
    return [
        'name' => $faker->name(),
        'surname' => $faker->name(),
        'position_held'=>$faker->word(),
        'phone_number'=> $faker->phoneNumber(),
        'email_address'=>$faker->email(),
    ];
});