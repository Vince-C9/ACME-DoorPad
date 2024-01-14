<?php


namespace Vince\AcmeDoorPad\Models;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    protected $guarded = [];
    protected $fillable = [
        'key'
    ];


    public function keypadUser(): BelongsTo{
        return $this->belongsTo(KeypadUser::class);
    }
}