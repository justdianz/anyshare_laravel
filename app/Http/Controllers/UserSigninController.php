<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSigninController extends Controller
{
    public function show()
    {
        return view('auth.signin');
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $user = User::select('status', 'role')->without('files')->where('email', '=', $credentials['email'])->first();
        if ($user && $user->status === 'banned') {
            return back()->with('gotBanned', 'Your account has been banned');
        }
        if (Auth::attempt($credentials, $request->input('remember'))) {
            $request->session()->regenerate();
            return $user->role === 'user' ? redirect()->intended('/my-files') :
                redirect('/admin');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
