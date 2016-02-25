<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
   
    public function index()
    {
        $user = User::all();

        if ($user) {
            response()->json([
                'message' => 'no',
                'code'    => '404',
                ]);
        }else
        {
            response()->json([
                'data' => $user,
                ]);
        }
    }


    public function getLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if(Auth;:atempt([ 'email' => $email, 'password' => $password])){

    }
    }
    

}
