<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Tampilkan semua user
    public function index()
    {
        $users = User::all();
        return view('dashboard.user.index', compact('users'));
    }

    // Tampilkan form tambah user
    public function create()
    {
        return view('dashboard.user.create', ['user' => null]);
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:user,admin,maskapai',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password, // <- plaintext (kalau belum mau pakai hash)
            'role'     => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.user.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required|in:user,admin,maskapai',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil diupdate.');
    }

    // Hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
