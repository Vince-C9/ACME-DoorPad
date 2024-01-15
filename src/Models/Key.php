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
        'key',
        'keypad_user_id'
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
    public static function assignKey(int $user_id, int $key){

        $sql = "UPDATE keys SET keypad_user_id = ? WHERE keypad_user_id IS NULL AND key = ?";

        try{
            DB::Update($sql, [$user_id, $key]);
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
    public static function stripKey(int $user_id){

        /**
         * To show eloquent proficiency
         */
        try{
            Key::where('keypad_user_id','=',$user_id)->update([
                'keypad_user_id'=>null,
            ]);
            return true;
        }catch(\Throwable $t){
            dd($t->getMessage());
            report($t->getMessage());
        }
        return false;
    }


    /**
     * Figures out if the key exists before doing anything bigger.
     *
     * @param $key
     * @return bool
     */
    public static function exists($key){
       $sql = "SELECT id FROM keys WHERE key = ?";
       $result = DB::Select($sql, [$key]);
       return count($result) !== 0;
    }
}