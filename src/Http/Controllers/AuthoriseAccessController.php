<?php


namespace Vince\AcmeDoorPad\Http\Controllers;


use Illuminate\Routing\Controller;
use Vince\AcmeDoorPad\Http\Requests\DoorAccessRequest;
use Vince\AcmeDoorPad\Models\Key;

class AuthoriseAccessController extends Controller
{
    public function access_door(DoorAccessRequest $request){

        /*
         * I have this bit as a custom rule, but for some reason it made the whole site redirect on success...
         * I didn't have time to finish debugging it sadly.
         * */
        $result = Key::whereNotNull('keypad_user_id')->where('key','=',$request->key)->count();

        if($result==0){
            return response()->json([
                'status'=>'403',
                'message'=>'This key is no longer assigned to a user.'
            ],403);
        }

        return response()->json([
           'status'=>200,
           'message'=>'Access Granted!' 
        ],200);
    }

}