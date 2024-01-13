<?php

use Vince\AcmeDoorPad\Models\Key;
use Vince\AcmeDoorPad\Services\KeyCodes\KeyCodeService;



$factory->define(Key::class, function(Faker\Generator $faker){
    $keyService = new KeyCodeService;
    return [
        'key'=>$keyService->generateUniqueKey()
    ];
});