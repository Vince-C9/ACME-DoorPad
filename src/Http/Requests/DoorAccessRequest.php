<?php


namespace Vince\AcmeDoorPad\Http\Requests;


use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Vince\AcmeDoorPad\Rules\KeyIsNotAssigned;

class DoorAccessRequest extends FormRequest
{
    public function authorize(): bool
    {
        /**
         * This is where we'd plumb in any complicated rules, like are you authorised to access.  For a simple thing like this, we can just return as true
         * */

        if(is_null(config('acme'))){
            throw new AuthorizationException('We cannot authorise this request because the ACME Door Pad Package has not been properly published.  Please run "php artisan vendor:publish --tag=acme-config" and try again.');
        }
        return true;
    }

    public function rules(): array
    {
        //Because there are many kinds of CSV, we need to account for that in full to support these csv types.  Further validation could go in around this in the form of custom rules to be 100%
        //that we have the right type of text file.
        return [
            'key'=>['required','integer','digits:6','exists:connection.keys,key', new KeyIsNotAssigned]
        ];
    }

    public function messages()
    {

        return [
          'key.required' => config('acme.door_key_errors.required'),
          'key.integer' => config('acme.door_key_errors.number'),
          'key.digits' => config('acme.door_key_errors.size'),
          'key.exists' => config('acme.door_key_errors.exists')
        ];
    }
}
