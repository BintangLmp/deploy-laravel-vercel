<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        $pengaduans = $user->pengaduans;
        return view('pengaduan.index', compact('pengaduans'));
    }
    public function listPetugas()
    {
        $petugas = User::where('role', 'petugas')->get(); 
        return view('pages.admin.petugas.index', compact('petugas'));
    }
}
