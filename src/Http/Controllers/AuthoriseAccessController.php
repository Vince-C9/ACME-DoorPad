<?php


namespace Vince\AcmeDoorPad\Http\Controllers;


use Illuminate\Routing\Controller;
use Vince\AcmeDoorPad\Http\Requests\DoorAccessRequest;

class AuthoriseAccessController extends Controller
{
    public function access_door(DoorAccessRequest $request){
        return response()->json([
           'status'=>200,
           'message'=>'Access Granted!' 
        ]);
    }

}