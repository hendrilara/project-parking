<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Laravel\Socialite\Contracts\Provider;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
//use Laravel\Socialite\Contracts\Provider as ProviderContract;

class SocialAccountService
{
    public function createOrGetUser(Provider $provider)
    {	
    	$providerUser = $provider->user();
    	$providerName = class_basename($provider);
        $account = SocialAccount::whereProvider($providerName)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            $user = $account->user;
            return response( JWTAuth::fromUser($user), 200 );
            //return response()->json($account->user);
        } else {

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $providerName,
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    //'password' => $providerUser->getPassword(),
                    'avatar' => $providerUser->getAvatar(),
                   // 'token'  => $providerUser->getToken(),
                ]);
            }

            
            $account->user()->associate($user);
           // $account->save();

            $token = JWTAuth::fromUser($account);
            return response( compact( 'token' ), 200 );

            //return response( JWTAuth::fromUser($user), 200 );
          //  return response()->json($user);
            //return $user;
        }

    }

}
