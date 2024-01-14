<?php


namespace Vince\AcmeDoorPad\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class KeypadUser extends Model
{
    protected $guarded = [];
    protected $fillable = [
        'name',
        'surname',
        'position_held',
        'phone_number',
        'email_address',
    ];

    public function key(): HasOne{
        return $this->hasOne(Key::class);
    }

    public static function hasKeyAssigned($user_id){
        //Raw SQL as the keys could be very numerous - we want to keep this rapid.
        $userKeySQL = "SELECT id FROM keys WHERE keypad_user_id = ?";
        $result = DB::Select($userKeySQL, [$user_id]);

        //!=0 instead of 1 in case we move away from single keys
        return count($result)!==0;
    }
}