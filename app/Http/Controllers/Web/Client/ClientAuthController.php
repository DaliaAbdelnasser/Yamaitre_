<?php

namespace App\Http\Controllers\Web\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Redirect;
use Auth;
use Str;
use URL;
use File;
use Password;


class ClientAuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function registerForm()
    {
        return view('client.register');
    }
    
    public function register(Request $request)
    {
        try {
            
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name'             => 'required|regex:/^(?![\s.]+$)[a-zA-Z\s.]*$/|max:100|min:5',
                    'phone'            => 'required|max:11|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|unique:clients',
                    'whatsapp'         => 'nullable|max:11|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
                    'email'            => 'required|email|unique:users|email',
                    'governorates'     => 'required',
                    'password'         => 'required|confirmed',
                ]
            );
            

            if ($validateUser->fails()) {
                return Redircet::back()->withErrors(['msg' => $validateUser->errors()]);
            }

            // client
            $client = Client::create([
                'phone'        => $request->phone,
                'governorates' => $request->governorates,
            ]);

            // user
            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => bcrypt($request->password),
                'user_role' => 'client',
                'client_id' => $client->id,
            ]);

            auth()->login($user);
            return redirect()->route('client.dashboard');

        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['msg' => $th->getMessage()]);
        }
    }
    // public function dashboard()
    // {
    //     if(Auth::check()){
    //         return view('client.dashboard');
    //     }
    //     return redirect("login")->withSuccess('are not allowed to access');
    // }

    public function update_profile()
    {
        return view('client.update-profile');   
    }
}
