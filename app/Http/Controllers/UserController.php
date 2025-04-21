<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index()
    {
        $users = User::with('roles')->get();  // Mengambil pengguna dengan relasi roles
        return view('users.index', compact('users'));
    }

    // Menampilkan detail pengguna
    public function show(User $user)
    {
        return view('users.show', compact('user'));  // Menampilkan detail pengguna
    }

    // Menampilkan halaman form untuk membuat pengguna baru
    public function create()
    {
        $roles = Role::all();  // Mendapatkan semua role untuk pilihan
        return view('users.create', compact('roles'));
    }

    // Menyimpan pengguna baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,id',  // Validasi untuk role
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    
        // Menyinkronkan role dengan user dan menambahkan user_type
        $user->roles()->sync([
            $request->role => ['user_type' => 'admin'] // Atau 'superadmin' tergantung role yang dipilih
        ]);
    
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }
    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|exists:roles,id',  // Validasi untuk role
            'password' => 'nullable|string|min:8|confirmed',  // Validasi untuk password (nullable)
        ]);
    
        // Update nama dan email
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
    
        // Update password jika ada
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
    
        // Menyinkronkan role baru dan menambahkan user_type
        $user->roles()->sync([
            $request->role => ['user_type' => 'admin'] // Sesuaikan dengan role yang dipilih
        ]);
    
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }
    public function edit(User $user)
{
    $roles = Role::all();  // Get all roles for selection
    return view('users.edit', compact('user', 'roles'));
}

public function destroy($id)
{
    // Find the user by ID
    $user = User::find($id);

    if ($user) {
        // Delete the user
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    } else {
        return redirect()->route('users.index')->with('error', 'User not found');
    }
}

    // Memperbarui data pengguna
   
}
