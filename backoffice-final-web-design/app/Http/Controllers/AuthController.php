<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function signIn()
    {
        return view('accounts-sign-in');
    }

    public function processAuthentication(Request $request)
    {
        if ($request->filled('username') && $request->filled('password')) {
            $user = User::where('username', $request->username)
                        ->where('password', $request->password)
                        ->first();
            Session::put('auth-user', $user);

            if ($user) {
                return redirect()->route('article_list');
            } else {
                redirect()->route('accounts_sign_in')->with('error', 'Vérifier vos identifiants');
            }
        } else {
            return redirect()->route('accounts_sign_in')->with('error', 'Vérifier vos identifiants');
        }
    }
}
