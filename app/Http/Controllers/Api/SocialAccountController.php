<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SocialAccountService;
use Socialite;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\SocialAccount;

class SocialAccountController extends Controller
{
    
    public function redirect($provider)
    {
        //return Socialite::with($provider)->stateless->user();
        return Socialite::driver($provider)->redirect();

     //   $user = Socialite::driver($provider)->user();
    }
    
    public function callback(SocialAccountService $service, $provider)
    {   

        $user = $service->createOrGetUser(Socialite::driver($provider));

        //return $user;
        //auth()->login($user);
        dd($user);
      //  return redirect('/');
    }



    public function redirectLogin($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callbackLogin($provider)
    {
        $user = Socialite::driver($provider)->user();
       // $social_user = User::where('provider', $provider)->where('provider_user_id', $user->id)->first();
        if($user){

            $account_social = $user->user;
        }
        return response( JWTAuth::fromUser( $user ), 200 );
    }
    
}
