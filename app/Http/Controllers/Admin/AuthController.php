<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            'email' => 'email|required|exists:admins,email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        $authenticated = Auth::guard('admin')->attempt($credentials, $request->has('remember'));

        if (!$authenticated){
            return redirect()->back()->with('error', 'email atau password salah.')->withInput(request(['email']));
        }

        return redirect()->intended('/admin/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'Berhasil logout');
    }
}