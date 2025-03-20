<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;
use Laravel\Socialite\Facades\Socialite;
 use Illuminate\Foundation\Auth\User as Authenticatable;


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
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $providers = [
        'facebook','google','twitter'
    ];
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function show()
    {
        return view('auth.login');
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($driver)
    {
        if( ! $this->isProviderAllowed($driver) ) {
            return $this->sendFailedResponse("{$driver} is not currently supported");
        }
        try {
            return Socialite::driver($driver)->redirect();
        } catch (Exception $e) {
            // You should show something simple fail message
            return $this->sendFailedResponse($e->getMessage());
        }
    }
  
    public function handleProviderCallback( $driver )
    {
        try {
            $user = Socialite::driver($driver)->user();
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }

        // check for email in returned user
        return empty( $user->email )
            ? $this->sendFailedResponse("No email id returned from {$driver} provider.")
            : $this->loginOrCreateAccount($user, $driver);
    }

    protected function sendSuccessResponse()
    {
        return redirect()->intended('home');
    }

    protected function sendFailedResponse($msg = null)
    {
        return redirect()->route('social.login')
            ->withErrors(['msg' => $msg ?: 'Unable to login, try with another provider to login.']);
    }
    
    protected function loginOrCreateAccount($providerUser, $driver)
    {
        // check for already has account
        $user = User::where('email', $providerUser->getEmail())->first();

        // if user already found
        if( $user ) {
            // update the avatar and provider that might have changed
            $user->update([
                'image' => $providerUser->avatar,
                'provider' => $driver,
                'provider_id' => $providerUser->id,
                'access_token' => $providerUser->token
            ]);
        } else {
            if($driver == 'google'){
                 $User = new User;
                $User->first_name = $providerUser->user['given_name'];
                $User->last_name = $providerUser->user['family_name'];
                $User->email = $providerUser->getEmail();
                $User->type = 'Shopper';
                $User->image = $providerUser->getAvatar();
                $User->provider = $driver;
                $User->provider_id = $providerUser->getId();
                $User->access_token = $providerUser->token;
                $User->password = '';
             
                $User->save();
            }else{
                $User = new User;
                $User->first_name = $providerUser->getName();
                $User->email = $providerUser->getEmail();
                $User->type = 'Shopper';
                $User->image = $providerUser->getAvatar();
                $User->provider = $driver;
                $User->provider_id = $providerUser->getId();
                $User->access_token = $providerUser->token;
                $User->password = '';
             
                $User->save();
            }
            Auth::login($User, true);
            $User->sendEmailVerificationNotification();
        }
        // login the user
        return $this->sendSuccessResponse();
    }

    private function isProviderAllowed($driver)
    {
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }
}
