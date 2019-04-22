<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Session;
use Pap_Api_Session;


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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('affiliate.auth.login');
    }

    public function username()
    {
        return 'username';
    }

    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        // Action login
        $session = new Pap_Api_Session( config('ulu.server') );
        if(!@$session->login( $request->input('username') , $request->input('password'),Pap_Api_Session::AFFILIATE, 'vi' )) {
            throw ValidationException::withMessages([
                $this->username() => ["Lỗi: ".$session->getMessage()],
            ]);
        }


        session()->put('affiliate', $session );

        $affiliate = Affiliate::where('username', $request->input('username') )->first();
        if( $affiliate->password == '' ){
            $affiliate->password =  Hash::make($request->input('password')) ;
            $affiliate->pap_password = $request->input('password');
            $affiliate->save();
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);

    }

    protected function authenticated(Request $request, $user)
    {

        return redirect()->route('affiliate.dashboard');
    }

}
