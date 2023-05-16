<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Hash;
use Auth;
use Redirect;

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
        // protected $redirectToClient = RouteServiceProvider::CLIENTDASHBOARD;
        // protected $redirectToLawyer = RouteServiceProvider::LAWYERDASHBOARD;
    
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }

    // public function login(Request $request)
    // {
    //     $cred = $request->validate([
    //         'email'    => 'required|email',
    //         'password' => 'required',
    //     ]);


    //     if( Auth::attempt( ['email' => $cred['email'], 'password' => $cred['password']] ) ){
    //         if(Auth::user()->user_role == 'admin'){

    //             return redirect()->route('admin.dashboard',app()->getLocale());
    //         }
    //         elseif(Auth::user()->user_role == 'client'){
    //             return redirect()->route('client.dashboard',app()->getLocale());

    //         }
    //         elseif(Auth::user()->user_role == 'lawyer'){
    //             return redirect()->route('lawyer.dashboard',app()->getLocale());

    //         }
    //         // else{
    //         //     return back();
    //         // }
    //     }
    //     else{
    //         // return Redirect::back()->withErrors([
    //         //     'password' => 'cred does not match please try again.'
    //         // ]);

    //         return Redirect::back()->withErrors($this->getMessages())->onlyInput($request->all());
    //     }

    // }

    // protected function getMessages()
    // {
    //     return $messages =[
    //         'email'    => __('login_mess.email'),
    //         'password' => __('login_mess.password'),
    //     ];
    // }


}
