<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Jika sudah punya token di session, langsung arahkan ke halaman master
        if (Session::has('jwt_token')) {
            return redirect()->route('master.index');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            // Hit webservice login
            $response = Http::post('https://jwt-auth-eight-neon.vercel.app/login', [
                'email' => $request->email,
                'password' => $request->password,
            ]);

            if ($response->successful() && isset($response['refreshToken'])) {
                // Simpan token dan email di session agar bisa dipakai untuk request selanjutnya
                Session::put('jwt_token', $response['refreshToken']);
                Session::put('user_email', $request->email);
                
                return redirect()->route('master.index')->with('success', 'Login berhasil!');
            }

            return back()->with('error', 'Email atau password salah.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal terhubung ke server autentikasi.');
        }
    }

    public function logout()
    {
        $token = Session::get('jwt_token');

        if ($token) {
            // Hit webservice logout dengan membawa token
            Http::withToken($token)->get('https://jwt-auth-eight-neon.vercel.app/logout');
        }

        // Hapus session
        Session::forget(['jwt_token', 'user_email']);
        
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}