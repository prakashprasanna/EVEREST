<?php
 
namespace App\Http\Controllers\Auth;
 
use Cache; 
use App\LoginUser;
use Illuminate\Http\Request;
use App\Exceptions\SocialAuthException;
 
class LoginController extends Controller
{
    protected $loginUser;
 
    public function __construct(LoginUser $loginUser)
    {
        $this->loginUser = $loginUser;
    }
 
    public function showLoginPage()
    {
       return view('auth.login');
    }
 
    public function showDashboard()
    {
        return view('dashboard');
    }
 
    public function auth($provider)
    {
        return $this->loginUser->authenticate($provider);
    }
 
    public function login($provider)
    {
        try {
            $this->loginUser->login($provider);
            return redirect()->action('App\Http\Controllers\Auth\LoginController@showDashBoard');
        } catch (SocialAuthException $e) {
            return redirect()->action('App\Http\Controllers\Auth\LoginController@showLoginPage')
                ->with('flash-message', $e->getMessage());
        }
    }
 
    public function logout()
    {
       auth()->logout();
       Cache::flush();
       return redirect()->to('/'); 
    }
}