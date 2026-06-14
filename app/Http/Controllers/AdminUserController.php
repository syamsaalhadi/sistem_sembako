<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('pengguna.index', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:admin,username',
            'password' => 'required|min:6'
        ]);

        Admin::create([
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $rules = [
            'username' => 'required|unique:admin,username,' . $id . ',id_admin',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'min:6';
        }

        $request->validate($rules);

        $data = ['username' => $request->username];
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return back()->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);

        // Jangan hapus diri sendiri
        if ($admin->id_admin == Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang login.');
        }

        $admin->delete();

        return back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
