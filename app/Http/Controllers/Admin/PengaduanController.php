<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{

    public function index()
    {
        $pengaduanCount = Complaint::count();
        $prosesCount = Complaint::where('status', 'proses')->count();
        $selesaiCount = Complaint::where('status', 'selesai')->count();

        $pengaduan = Complaint::orderBy('created_at', 'desc')->paginate(10);

        return view('pengaduan.index', compact('pengaduanCount', 'prosesCount', 'selesaiCount', 'pengaduan'));
    }
    public function create()
    {
        return view('pengaduan.create');
    }
    public function store(Request $request)
    {
        // Validasi data input dari pengguna
        $validatedData = $request->validate([
            'judul_laporan' => 'required|max:255',
            'isi_laporan' => 'required',
            'tgl_kejadian' => 'required|date',
            'lokasi_kejadian' => 'required|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            // Proses upload file foto
            $fotoPath = $request->file('foto')->store('pengaduan_foto', 'public');

            // Simpan data pengaduan ke database
            Complaint::create([
                'judul_laporan' => $validatedData['judul_laporan'],
                'isi_laporan' => $validatedData['isi_laporan'],
                'tgl_kejadian' => $validatedData['tgl_kejadian'],
                'lokasi_kejadian' => $validatedData['lokasi_kejadian'],
                'foto' => $fotoPath,
                'user_id' => Auth::id(), // ID pengguna yang login
                'status' => 'pending',  // Status awal 'pending'
            ]);

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dibuat!');
        } catch (\Exception $e) {
            // Penanganan error jika proses gagal
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan pengaduan. Silakan coba lagi.']);
        }
    }

    /**
     * Menampilkan detail pengaduan tertentu.
     * 
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\View\View
     */
    public function show(Complaint $pengaduan)
    {
        return view('pengaduan.show', compact('pengaduan'));
    }

    /**
     * Menampilkan form untuk mengedit pengaduan.
     * 
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\View\View
     */
    public function edit(Complaint $pengaduan)
    {
        // Pastikan hanya pemilik pengaduan yang bisa mengedit
        if ($pengaduan->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('pengaduan.edit', compact('pengaduan'));
    }

    /**
     * Memperbarui pengaduan yang sudah ada di database.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Complaint $pengaduan)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'judul_laporan' => 'required|max:255',
            'isi_laporan' => 'required',
            'tgl_kejadian' => 'required|date',
            'lokasi_kejadian' => 'required|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            // Update data pengaduan
            $pengaduan->update($validatedData);

            // Jika ada file foto baru, hapus yang lama dan simpan yang baru
            if ($request->hasFile('foto')) {
                if (Storage::disk('public')->exists($pengaduan->foto)) {
                    Storage::disk('public')->delete($pengaduan->foto);
                }
                $pengaduan->foto = $request->file('foto')->store('pengaduan_foto', 'public');
                $pengaduan->save();
            }

            return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui pengaduan. Silakan coba lagi.']);
        }
    }

    /**
     * Menghapus pengaduan.
     * 
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Complaint $pengaduan)
    {
        try {
            // Hapus file foto jika ada
            if ($pengaduan->foto && Storage::disk('public')->exists($pengaduan->foto)) {
                Storage::disk('public')->delete($pengaduan->foto);
            }

            // Hapus data pengaduan
            $pengaduan->delete();

            return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus pengaduan. Silakan coba lagi.']);
        }
    }
}
