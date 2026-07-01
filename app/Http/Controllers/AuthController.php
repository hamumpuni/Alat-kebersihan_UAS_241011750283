<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan form login.
     */
  public function showLoginForm()
{
    if (Auth::check()) {
        // Arahkan ke dashboard jika sudah login
        return redirect()->route('admin.dashboard'); 
    }

    return view('auth.login'); 
}
    /**
     * Proses login menggunakan kolom username (bukan email).
     */
    public function login(Request $request)
    {
        // 1. Validasi input dari form
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // 2. Coba melakukan login
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Jika berhasil, arahkan ke dashboard admin
            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang kembali!');
        }

        // 3. Jika gagal (username tidak ada atau password salah), kembalikan ke form
        return back()
            ->withErrors(['username' => 'Username atau password yang Anda masukkan salah.'])
            ->onlyInput('username');
    }

    /**
     * Logout dan hancurkan sesi.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }
}