<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        return view('pages.login',[
            "title" => "Login"
        ]);
    }

    public function proses_login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Jika autentikasi berhasil
            return redirect()->intended('/');
        }

        if (Auth::attempt($credentials)) {
            return redirect()->route('homepage')->with('success', "Login akun berhasil");
        } else {
            return redirect()->route('login')->with('error', "Invalid Email or Password");
        }
    }

    public function registerform(){
        return view('pages.register',[
            "title" => "Register"
        ]);
    }

    public function proses_register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Autentikasi pengguna setelah registrasi
        Auth::login($user);

        return redirect()->intended('/')->with('succes', 'Logout Succesfully');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Untuk menghapus sesi pengguna setelah logout
        $request->session()->invalidate();

        // Untuk menghapus cookie autentikasi yang mungkin ada
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('succes', 'Logout Succesfully');
    }
}
