<?php
namespace App;

use App\Exceptions\SocialAuthException;
use Exception;
use Socialite;
use file;
use Auth;
use App\User;


class LoginUser
{
   
    public function authenticate($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
 
    public function login($provider)
    {
            $socialUserInfo = Socialite::driver($provider)->stateless()->user();
 
            $user = User::firstOrCreate(['name' => $socialUserInfo->getName(),
                                         'email' => $socialUserInfo->getEmail(),
                                         'avatar' => $socialUserInfo->getAvatar()]);
             
            $socialProfile = $user->socialProfile ?: new SocialLoginProfile;
            $providerField = "{$provider}_id";
            $socialProfile->{$providerField} = $socialUserInfo->getId();

            $emp = employee::where('AJV_EMP_Email', '=', $socialUserInfo->getEmail())->first();
            if($emp != null){            
            $user->socialProfile()->save($socialProfile);
 
            auth()->login($user);
            }
    }

}