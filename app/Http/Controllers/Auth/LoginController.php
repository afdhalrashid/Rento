<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    // protected $redirectTo = RouteServiceProvider::HOME;

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
        return view('auth.login2');
    }

    protected function validateLogin(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            $this->username() => 'exists:users,' . $this->username() . ',status,1',
            'password' => 'required|string',
        ], [
            $this->username() . '.exists' => 'Emel yang dimasukkan tidak berdaftar atau telah disekat. Sila hubungi pentadbir sistem sekiranya anda adalah pengguna yang sah'
        ]);
    }

    protected function authenticated(Request $request, $user)
    {
        // if ( $user->isAdmin() ) {// do your magic here
        //     return redirect()->route('dashboard');
        // }

        if(!$user->hasVerifiedEmail()){
            Auth::logout();
            return redirect('/login')->with('message', 'Sila sahkan akaun anda dengan dengan membuka emel pengesahan yang telah dihantar');
        }

        return redirect('/house');
        // return view('');
    }
}