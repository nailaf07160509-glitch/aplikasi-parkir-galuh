<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = DB::table('tb_user')
            ->orderByDesc('id_user')
            ->paginate(10);

        return view('admin.pengguna.index', compact('pengguna'));
    }

    public function create()
    {
        return view('admin.pengguna.create');
    }


public function store(Request $request)
{
    $request->validate([
        'nama_lengkap' => 'required|string|max:100',
        'username' => 'required|string|max:100',
        'password' => 'required|min:6',
        'role' => 'required|in:admin,petugas,owner',
    ]);

    $jumlah = DB::table('tb_user')
        ->where('username', $request->username)
        ->count();

    if ($jumlah > 0) {
        return back()
            ->withInput()
            ->withErrors([
                'username' => 'Username sudah digunakan. Silakan gunakan username lain.'
            ]);
    }

    DB::table('tb_user')->insert([
        'nama_lengkap' => $request->nama_lengkap,
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'status_aktif' => 1,
    ]);

    return redirect()
        ->route('admin.pengguna.index')
        ->with('success', 'Pengguna berhasil ditambahkan.');
}



    public function edit($id)
    {
        $user = DB::table('tb_user')
            ->where('id_user', $id)
            ->first();

        if (!$user) {
            abort(404);
        }

        return view('admin.pengguna.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = DB::table('tb_user')
            ->where('id_user', $id)
            ->first();

        if (!$user) {
            abort(404);
        }

        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'username' => 'required|string|max:100',
            'role' => 'required|in:admin,petugas,owner',
            'status_aktif' => 'required|in:0,1',
        ]);

        $sudahAda = DB::table('tb_user')
            ->where('username', $request->username)
            ->where('id_user', '!=', $id)
            ->exists();

        if ($sudahAda) {
            return back()->withInput()->withErrors([
                'username' => 'Username sudah digunakan.'
            ]);
        }

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'role' => $request->role,
            'status_aktif' => $request->status_aktif,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        DB::table('tb_user')
            ->where('id_user', $id)
            ->update($data);

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::table('tb_user')
            ->where('id_user', $id)
            ->delete();

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
