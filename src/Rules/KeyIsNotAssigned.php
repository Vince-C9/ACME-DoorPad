<?php


namespace Vince\AcmeDoorPad\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;
use Vince\AcmeDoorPad\Models\Key;

class KeyIsNotAssigned implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /*Including this seemed to send laravel on a weird loop.  I didn't have time to properly check why.*/
        //SQL faster here but wasn't working and I'm out of time!!! Aaaaah!
        $result = Key::whereNotNull('keypad_user_id')->where('key','=',$value)->count();

        if($result!==0){
            $fail('The key is no longer assigned to a user');
        }
    }

}