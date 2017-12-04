<?php
namespace App;
 
use App\Exceptions\SocialAuthException;
use Exception;
use Socialite;
use file;

class LoginUser
{
   
    public function authenticate($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
 
    public function login($provider)
    {
       // try {
            $socialUserInfo = Socialite::driver($provider)->user();
 
            $user = User::firstOrCreate(['name' => $socialUserInfo->getName(),
                                         'email' => $socialUserInfo->getEmail(),
                                         'avatar' => $socialUserInfo->getAvatar()]);
             
            $socialProfile = $user->socialProfile ?: new SocialLoginProfile;
            $providerField = "{$provider}_id";
            $socialProfile->{$providerField} = $socialUserInfo->getId();
            
            $user->socialProfile()->save($socialProfile);
 
            auth()->login($user);
 
  //      } catch (Exception $e) {
  //          throw new SocialAuthException("failed to authenticate with $provider");
    //    }
    }
}