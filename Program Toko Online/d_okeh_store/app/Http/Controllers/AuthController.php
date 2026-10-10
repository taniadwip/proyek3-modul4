<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller {
    public function showLogin() {
        if (session()->has('user_id')) {
            return redirect()->route('products.index');
        }
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $request->session()->regenerate();
            session([
                'user_id' => $user->id_user,
                'username' => $user->username,
                'nama_lengkap' => $user->nama_lengkap
            ]);
            return redirect()->intended(route('products.index'))->with('success', 'Selamat datang kembali di D\'Okeh Store!');
        }

        return back()->withErrors(['login' => 'Username atau password yang dimasukkan salah.']);
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'nama_lengkap' => 'required|max:100',
            'email' => 'required|email|unique:users,email|max:100',
            'username' => 'required|unique:users,username|max:50',
            'password' => 'required|min:6',
            'no_hp' => 'required|max:15',
            'alamat' => 'required'
        ]);

        $nextId = 'USR' . str_pad(User::count() + 1, 3, '0', STR_PAD_LEFT);

        User::create([
            'id_user' => $nextId,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran akun D\'Okeh berhasil! Silakan login.');
    }

    public function logout(Request $request) {
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('products.index')->with('success', 'Anda telah berhasil logout.');
    }
}