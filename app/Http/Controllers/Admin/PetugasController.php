<?php

namespace App\Http\Controllers\Admin;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Console\View\Components\Alert;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::all();

        return view('pages.admin.petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('pages.admin.petugas.create');
    }
    public function store(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nama_petugas' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'regex:/^\S*$/u', 'unique:petugas', 'unique:masyarakat,username'],
            'password' => ['required', 'string', 'min:6'],
            'telp' => ['required'],
            'roles' => ['required', 'in:admin,petugas'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        };

        $username = Petugas::where('username', $data['username'])->first();

        if ($username) {
            return redirect()->back()->with(['notif' => 'Username Telah Digunakan!']);
        }

        Petugas::create([
            'nama_petugas' => $data['nama_petugas'],
            'username' => strtolower($data['username']),
            'password' => Hash::make($data['password']),
            'telp' => $data['telp'],
            'roles' => $data['roles'],

        ]);


        Alert::success('Berhasil', 'Petugas telah ditambahkan!');
        return redirect()->route('petugas.index');
    }
    public function show($id)
    {
        //
    }
    public function edit($id_petugas)
    {
        $petugas = Petugas::where('id_petugas', $id_petugas)->first();

        return view('pages.admin.petugas.edit', compact('petugas'));
    }
    public function update(Request $request, $id_petugas)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nama_petugas' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'regex:/^\S*$/u', Rule::unique('petugas')->ignore($id_petugas, 'id_petugas'), 'unique:masyarakat,username'],
            'telp' => ['required'],
            'roles' => ['required', 'in:admin,petugas'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        };

        $petugas = Petugas::find($id_petugas);

        if ($data['password'] != null) {
            $password = Hash::make($data['password']);
        }

        $petugas->update([
            'nama_petugas' => $data['nama_petugas'],
            'username' => strtolower($data['username']),
            'password' => $password ?? $petugas->password,
            'telp' => $data['telp'],
            'roles' => $data['roles'],

        ]);


        Alert::success('Berhasil', 'Petugas berhasil diupdate!');
        return redirect()->route('petugas.index');
    }

    public function destroy(Request $request, $id_petugas)
    {
        $petugas = Petugas::find($id_petugas);

        if (!$petugas) {
            return response()->json(['error' => 'Petugas tidak ditemukan'], 404);
        }

        $petugas->delete();

        if ($request->ajax()) {
            return response()->json('success');
        }

        return redirect()->route('petugas.index');
    }
}
