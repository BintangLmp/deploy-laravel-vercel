<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\User;

class AdminController extends Controller
{
    public function index() {
        return view('pages.admin.dashboard', [
            'pengaduan' => Complaint::count(),
            'proses' => Complaint::where('status', 'proses')->count(),
            'selesai' => Complaint::where('status', 'selesai')->count(),
            'user' => User::count(),
        ]);
    }
}
