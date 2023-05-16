<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;


class AuthController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    
    public function login()
    {
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth('admin')->attempt($credentials)) {
            return redirect(route('admin.dashboard'));
        }

        Flash::error('من فضلك تأكد من صحة البيانات');
        return back();
    }

    public function logout()
    {
        auth('admin')->logout();

        return redirect(route('admin.login'));
    }
}
