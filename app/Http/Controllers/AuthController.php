<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ================= LOGIN =================
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email','password'))) {

            $request->session()->regenerate();

            $user = auth()->user();

            // redirect sesuai role
            if ($user->role == 'admin') {
                return redirect('/admin');
            } elseif ($user->role == 'merchant') {
                return redirect('/merchant');
            }

            return redirect('/');
        }

        return back()->with('error','Email atau password salah');
    }

    // ================= REGISTER =================
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>'merchant' // default user baru = merchant
        ]);

        // 🔥 auto bikin merchant profile
        Merchant::create([
            'user_id' => $user->id,
            'store_name' => $user->name . " Store",
            'city' => 'Belum diisi'
        ]);

        Auth::login($user);

        return redirect('/merchant');
    }

    // ================= LOGOUT =================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}