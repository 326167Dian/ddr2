<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Institusi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        $institusis = Institusi::all();

        return view('auth.register', compact('institusis'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'no_tlp' => 'required|string|max:20',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_tlp' => '+62' . ltrim($request->no_tlp, '0'),
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Login berhasil
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Jika fetch/AJAX → return JSON
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Login berhasil'
                ], 200);
            }

            // Jika form biasa
            return redirect('/seminar');
        }

        // Login gagal
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Email atau password salah'
            ], 401);
        }

        // Jika form biasa (non-AJAX)
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/homepage');
    }
}
