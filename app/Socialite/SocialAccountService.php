<?php

namespace App\Socialite;

use Laravel\Socialite\Contracts\User as ProviderUser;
//use Laravel\Socialite\Facades\Socialite as Socialite;
class SocialAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = SocialAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;e
        }

    }

    public function createGetPlus(ProviderUser $providerUser)
    {
        $account = SocialAccount::whereProvider('google')
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        }
        else
        {
            $account = New SocialAccount([
                    'provider_user_id' => $providerUser->getId,
                    'provider'         => 'google',
                ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {
                
                $user = User::create([
                     'email' => $providerUser->getEmail,
                     'name'  => $providerUser->getName,
                    ]);

            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }

}
