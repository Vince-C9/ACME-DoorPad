<?php


namespace Vince\AcmeDoorPad\Models;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Vince\AcmeDoorPad\Services\KeyCodes\KeyCodeService;

class Key extends Model
{
    protected $guarded = [];
    protected $fillable = [
        'key'
    ];


    /**
     * Set up relationship.
     * @return BelongsTo
     */
    public function keypadUser(): BelongsTo{
        return $this->belongsTo(KeypadUser::class);
    }


    /**
     * Assign user a the provided key as long as that key isn't already allocated.
     * Needs better error handling, but time!
     *
     * @param int $user_id
     * @param int $key
     * @param bool $new
     */
    public function assignKey(int $user_id, int $key){

        $sql = "UPDATE keys SET keypad_user_id = ? WHERE keypad_user_id IS NULL AND key = ?";

        try{
            $result = DB::Update($sql, [$user_id, $key]);
            return true;
        }catch(\Throwable $t){
            report($t->getMessage());
        }
        return false;
    }


    /**
     * Strip the provided users key from them.
     * Needs better error handling, but time!
     *
     * @param $user_id
     * @return bool
     */
    public function stripKey(int $user_id){
        $sql = "UPDATE keys SET keypad_user_id = NULL WHERE keypad_user_id = ?";

        try{
            $result = DB::Update($sql, [$user_id]);
            return true;
        }catch(\Throwable $t){
            report($t->getMessage());
        }
        return false;
    }
}