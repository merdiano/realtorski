<?php

namespace App\Http\Controllers;

use App\Models\Abonent;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function userLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        //dd(\auth('api'));
        //return response()->json(['success' => \auth()->guard('api')], 200);
        if(\auth()->attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            //$success['token'] =  $user->createToken('riyeltorski')->accessToken;
            return response()->json(['success' => $user], 200);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    public function userRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = Abonent::create($input);
        $success['token'] =  $user->createToken('riyeltorski')->accessToken;
        $success['name'] =  $user->name;
        return response()->json(['success'=>$success], 200);
    }


    public function userDetails()
    {
        $users = User::get();
        return response()->json(['success' => \auth()->user()], 200);
    }
}
