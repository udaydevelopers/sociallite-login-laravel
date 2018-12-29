<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Illuminate\Support\Facades\Auth;
use App\User;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $githubUser = Socialite::driver($provider)->user();

        $user = User::where('provider_id', $githubUser->getId())->first();

        // $user->token;
       // dd($githubUser);
        if(!$user){
            $name = $githubUser->getName();
            $Nickname = $githubUser->getNickname();
            if(empty($name)) 
            $name = $Nickname;
        $user = User::create([
                'email' => $githubUser->getEmail(),
                'name' => $name,
                'provider_id' => $githubUser->getId(),
                'provider_name' => $provider,
            ]);
        }

            Auth::login($user, true);
            return redirect('home');
    }
}
