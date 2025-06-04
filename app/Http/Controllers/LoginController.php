<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
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
        $email = strtolower($user->email);

        return match (true) {
            str_ends_with($email, '@admin.com') => '/admin',
            str_ends_with($email, '@petugas.com') => '/petugas',
            str_ends_with($email, '@dokter.com') => '/dokter',
            str_ends_with($email, '@kasir.com') => '/kasir',
            default => '/',
        };
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
