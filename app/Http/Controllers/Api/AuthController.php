<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\SocialAccount;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function register(Request $request)
    {
        $credentials = $request->only('name', 'email', 'password');
        $credentials[ 'password' ] = bcrypt( $credentials[ 'password' ] );
        $user = User::create($credentials);
       
        if ( isset($request['provider'] ) && isset( $request['provider_user_id'] ) && isset( $request['provider_token'] ) ) {
            $user->accounts()->save( new SocialAccount( [
                'provider' => $request['provider'],
                'provider_id' => $request['provider_id'],
                'provider_token' => $request['provider_token'],
            ] ) );
        }

        $token = JWTAuth::fromUser($user);

        return response( compact('token'), 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

            try{

                if (! $token = JWTAuth::attempt($credentials)) {
                     
                     return response()->json(['errors' => 'invalid_credentials'], 401);
                }
            }catch (JWTException $e){

                return response()->json(['errors' => 'could_not_create_token'], 500);
            }

            return response()->json(compact('token'));
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
            ]);
        JWTAuth::invalidate($request->input('token'));
    }

    public function getAuthenticatedUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }

}
