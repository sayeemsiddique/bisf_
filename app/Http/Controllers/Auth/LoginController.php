<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Session;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    // Login controller and redirect based on user role
    public function login(Request $request)
    {
        $validation = $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
            // 'mathcaptcha' => 'required|mathcaptcha',
        ]);
        
        if (Auth::attempt(['email'=>$request->username, 'password'=>$request->password]) or Auth::attempt(['mobile'=>$request->username, 'password'=>$request->password]))
        {
            if(auth()->user()->status == 1)
            {
                if (auth()->user()->role_id) 
                {
                    // customer == 7
                    if (auth()->user()->role_id == 7) {
                        // return redirect()->route('account');
                        return redirect()->back();
                    } else {
                        return redirect()->route('admin.index');
                    }
                }else {
                    Auth::logout();

                    return redirect()->back()->with('error', 'You are not a registered user of BISF!');
                    
                }
            }else{
                Auth::logout();

                return redirect()->back()->with('error', 'Invalid user...!');
            }
        } else {
            return redirect()->back()->with('error', 'Email or Phone or Password is invalid');
        }

    }

    public function user_logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    }

}
