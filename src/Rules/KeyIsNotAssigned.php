<?php


namespace Vince\AcmeDoorPad\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class KeyIsNotAssigned implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $sql = "SELECT id FROM keys WHERE keypad_user_id IS NOT NULL AND key = ?";
        $result = DB::Select($sql, [$value]);
        if(count($result)!==0){
            $fail('The key is no longer assigned to a user');
        }
    }

    public function message(){
        return 'This key is no longer assigned to a user.';
    }
}