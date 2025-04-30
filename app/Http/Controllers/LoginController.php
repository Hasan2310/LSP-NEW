<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    // Tampilkan form login
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Mencari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Jika user ditemukan dan password cocok
        if ($user && $user->password === $request->password) {
            // Login pengguna
            Auth::login($user);

            // Redirect berdasarkan role
            if ($user->role === 'user') {
                return redirect('/');
            } elseif (in_array($user->role, ['admin', 'maskapai'])) {
                return redirect('/dashboard');
            }
        }

        // Jika login gagal, kembalikan dengan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ]);
    }


    // Logout
    public function destroy($id = null)
    {
        Auth::logout();
        return redirect()->route('/');
    }

    // Fungsi lain tidak digunakan, tapi wajib ada
    public function create() {}
    public function show(Request $request) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}
}
