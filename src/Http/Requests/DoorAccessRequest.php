<?php


namespace Vince\AcmeDoorPad\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class DoorAccessRequest extends FormRequest
{
    public function authorize(): bool
    {
        /**
         * This is where we'd plumb in any complicated rules, like are you authorised to access.  For a simple thing like this, we can just return as true
         * */
        return true;
    }

    public function rules(): array
    {
        //Because there are many kinds of CSV, we need to account for that in full to support these csv types.  Further validation could go in around this in the form of custom rules to be 100%
        //that we have the right type of text file.
        return [
            'key'=>'required|integer|size:6|exists:connection.keys,key'
        ];
    }

    public function messages()
    {
        return [
          'key.required' => 'You must provide an access key.',
          'key.integer' => 'Your access key must be a number.',
          'key.size' => 'Your access key must be six digits.',
          'key.exists' => 'Invalid access key'
        ];
    }
}