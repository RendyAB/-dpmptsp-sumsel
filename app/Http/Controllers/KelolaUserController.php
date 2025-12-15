<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminVerifikator;
use Illuminate\Support\Facades\Hash;

class KelolaUserController extends Controller
{

    public function index()
    {
        $kelola_user = AdminVerifikator::all();
        return view('ptsp.kelola_user.view', compact('kelola_user'));
    }

    public function create()
    {
        $role = ['petugas', 'madya_1', 'madya_2', 'madya_3', 'kabid'];

        $usedRole = AdminVerifikator::pluck('role')->toArray();

        $availableRole = array_diff($role, $usedRole);

        return view('ptsp.kelola_user.create', compact('availableRole'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
            'nama_petugas' => 'required',
            'nip' => 'required'
        ]);

        $kelola_user = new AdminVerifikator;
        $kelola_user->username = $request->username;
        $kelola_user->password = Hash::make($request->password);
        $kelola_user->role = $request->role;
        $kelola_user->nama_petugas = $request->nama_petugas;
        $kelola_user->nip = $request->nip;

        $kelola_user->save();

        return redirect()->route('kelola_user_tampil')->with('success', 'User berhasil diSimpan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $kelola_user = AdminVerifikator::findOrFail($id);

        return view('ptsp.kelola_user.edit', compact('kelola_user'));
    }

    public function update(Request $request, string $id)
    {
        $kelola_user = AdminVerifikator::findOrFail($id);

        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
            'nama_petugas' => 'required',
            'nip' => 'required'
        ]);

        $kelola_user = new AdminVerifikator;
        $kelola_user->username = $request->username;
        $kelola_user->password = Hash::make($request->password);
        $kelola_user->role = $request->role;
        $kelola_user->nama_petugas = $request->nama_petugas;
        $kelola_user->nip = $request->nip;

        $kelola_user->update();

        return redirect()->route('kelola_user_tampil')->with('success', 'User berhasil diUpdate');
    }

    public function destroy(string $id)
    {
        $kelola_user = AdminVerifikator::findOrFail($id);

        $kelola_user->delete();

        return redirect()->route('kelola_user_tampil');
    }
}
