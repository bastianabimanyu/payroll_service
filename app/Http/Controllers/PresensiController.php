<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    public function index()
    {
        $presensis = Presensi::where('username', Auth::user()->name)->get();
        return view('presensi.index', compact('presensis'));
    }

    public function indexadmin()
    {
        $presensis = Presensi::latest()->get();
        return view('presensi.indexadmin', compact('presensis'));
    }

    public function store(Request $request)
    {
        // Cek apakah sudah presensi hari ini
        $sudahPresensi = Presensi::where('username', Auth::user()->name)
            ->where('tanggal', date('Y-m-d'))
            ->exists();

        if ($sudahPresensi) {
            return back()->with('error', 'Kamu sudah presensi hari ini!');
        }

        Presensi::create([
            'username' => Auth::user()->name,
            'tanggal' => date('Y-m-d'),
            'jam_masuk' => now()->setTimezone('Asia/Jakarta')->format('H:i:s'),
        ]);

        return back()->with('success', 'Presensi berhasil!');
    }

    public function presensiKeluar()
{
    $presensi = Presensi::where('username', Auth::user()->name)
        ->where('tanggal', date('Y-m-d'))
        ->first();

    if (!$presensi) {
        return back()->with('error', 'Kamu belum presensi masuk hari ini!');
    }

    if ($presensi->jam_keluar) {
        return back()->with('error', 'Kamu sudah presensi keluar!');
    }

    $presensi->update([
        'jam_keluar' => now()->setTimezone('Asia/Jakarta')->format('H:i:s'),
    ]);

    return back()->with('success', 'Presensi keluar berhasil!');
}

public function destroy(string $id)
    {
        $deletedata = Presensi::findOrFail($id);

        $deletedata->delete();

        return redirect()->route('admin.presensi')->with('success', 'Data Berhasil Dihapus');
    }
}
