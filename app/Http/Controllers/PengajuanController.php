<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuan = Pengajuan::latest()->get();
        return view('admin.pengajuan.index', compact('pengajuan'));
    }


    public function create()
    {
        $pengajuan = Pengajuan::latest()->get();
        return view('user.pengajuan.create', compact('pengajuan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namapengaju' => 'required|string|max:100',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        Pengajuan::create([
            'nama_pengaju' => $request->namapengaju,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Pengajuan berhasil dikirim.');
    }

    public function konfirmasi($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->update([
            'status' => 'diterima',
            'tanggal_respon' => now(),
        ]);

        return redirect()->back()->with('success', 'Pengajuan diterima.');
    }

    public function tolak($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->update([
            'status' => 'ditolak',
            'tanggal_respon' => now(),
        ]);

        return redirect()->back()->with('success', 'Pengajuan ditolak.');
    }

}
