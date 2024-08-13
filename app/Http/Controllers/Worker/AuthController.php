<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('worker.auth.login');
    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            'email' => 'email|required|exists:users,email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        $authenticated = Auth::attempt($credentials, $request->has('remember'));

        if (!$authenticated){
            return redirect()->back()->with('error', 'email atau password salah.')->withInput(request(['email']));
        }

        return redirect()->intended('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout');
    }
}