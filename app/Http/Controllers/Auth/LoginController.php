<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use HP;
use App\User;
use Illuminate\Http\Request;
use Validator;
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

     public function login(Request $request)
     {

        $validator=Validator::make($request->all(),[
            'tahun'=>'required|numeric'
        ]);

        if($validator->fails()){
            return back()->withInput()->withError($validator);
        }

         $this->validateLogin($request);
         // If the class is using the ThrottlesLogins trait, we can automatically throttle
         // the login attempts for this application. We'll key this by the username and
         // the IP address of the client making these requests into this application.
         if ($this->hasTooManyLoginAttempts($request)) {
             $this->fireLockoutEvent($request);
             return $this->sendLockoutResponse($request);
         }

         if ($this->attemptLogin($request)) {
            $user=User::where('email',$request->email)->first();
            $token_api=HP::GenerateTokenApi($user);
            
            session(['focus_tahun' => $request->tahun]);

            $user->api_token=$token_api;
            $user->save();

            return $this->sendLoginResponse($request);
         }
         // If the login attempt was unsuccessful we will increment the number of attempts
         // to login and redirect the user back to the login form. Of course, when this
         // user surpasses their maximum number of attempts they will get locked out.
         $this->incrementLoginAttempts($request);
         return $this->sendFailedLoginResponse($request);
      }




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
}
