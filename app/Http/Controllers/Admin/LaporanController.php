<?php

namespace App\Http\Controllers\Admin;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    public function index()
    {
        // Menampilkan halaman laporan
        return view('pages.admin.laporan.index');
    }

    public function laporan(Request $request)
    {
        // Ambil filter tanggal dari request
        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        // Query data pengaduan dengan filter tanggal
        $pengaduan = Complaint::query();

        if ($date_from && $date_to) {
            $pengaduan->whereBetween('tgl_pengaduan', [
                $date_from . ' 00:00:00',
                $date_to . ' 23:59:59',
            ]);
        }

        return view('pages.admin.laporan.index', [
            'pengaduan' => $pengaduan->get(),
            'from' => $date_from,
            'to' => $date_to,
        ]);
    }

    public function export(Request $request)
    {
        // Ambil filter tanggal dari request
        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        // Query data pengaduan dengan filter tanggal
        $pengaduan = Complaint::query();

        if ($date_from && $date_to) {
            $pengaduan->whereBetween('tgl_pengaduan', [
                $date_from . ' 00:00:00',
                $date_to . ' 23:59:59',
            ]);
        }

        // Load data ke dalam PDF
        $pdf = PDF::loadView('pages.admin.laporan.export', [
            'pengaduan' => $pengaduan->get(),
        ]);

        // Unduh file PDF
        return $pdf->download('laporan.pdf');
    }
}
