<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;

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
    protected $redirectTo = '/story-list';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        $agent = new Agent();
        if($agent->isMobile()){
            $message = 'Your device is not supported by the tool. To use the Monitool, please access the site on a PC or tablet.';
            return redirect('/')->with('message', $message);
        }
        else{
            return view('auth.login');
        }
    }

    protected function credentials(Request $request)
    {
        // get email from login and store it in the session
        $SessionMail = $request->only($this->username());
        $SessionMail = $SessionMail["email"];
        Session::put('email', $SessionMail);

        // hashed email before it get send to the db
        $Credentials = $request->only($this->username(), 'password');
        $Credentials[$this->username()] = hash('sha256', $Credentials[$this->username()]);

        return $Credentials;
    }
}
