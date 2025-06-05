<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if($user = auth::user())
        {
            return redirect()->to($this->redirectToPanel($user));
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            return redirect()->to($this->redirectToPanel($user));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    protected function redirectToPanel($user)
    {
        $role = strtolower($user->role);

        return match (true) {
            default => false,
            $role == 'admin' => 'admin',
            $role == 'officer' => 'petugas',
            $role == 'doctor' => 'dokter',
            $role == 'cashier' => 'kasir',
        };
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
