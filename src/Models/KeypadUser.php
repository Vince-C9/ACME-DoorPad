<?php


namespace Vince\AcmeDoorPad\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

}