<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gaji;
use App\Models\User;

class GajiController extends Controller
{
    public function index()
    {
        $gajis = Gaji::with('user')->latest()->get();
        return view('admin.gaji.index', compact('gajis'));
    }


    public function create()
    {
        $users = User::all();
        return view('admin.gaji.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'bulan' => 'required|string',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'required|numeric',
            'potongan' => 'required|numeric',
        ], [
            'bulan.required' => 'Bulan wajib diisi.',
            'gaji_pokok.required' => 'Gaji pokok wajib diisi.',
            'tunjangan.required' => 'Tunjangan wajib diisi.',
            'potongan.required' => 'Potongan wajib diisi.',
            'bulan.string' => 'Penulisan harus menggunakan huruf',
            'gaji_pokok.numeric' => 'Gaji pokok wajib menggunakan angka.',
            'tunjangan.numeric' => 'Tunjangan wajib menggunakan angka.',
            'potongan.numeric' => 'Potongan wajib menggunakan angka.',
        ]);

        $data['total_gaji'] = ($data['gaji_pokok'] + ($data['tunjangan'] ?? 0)) - ($data['potongan'] ?? 0);
        $data['status'] = 'Belum Dibayar';

        Gaji::create($data);

        return redirect()->route('gaji')->with('success', 'Gaji berhasil ditambahkan.');
    }

    public function show(Gaji $gaji)
    {
        return view('admin.gaji.show', compact('gaji'));
    }

    public function bayar($id)
{
    // Ambil data gaji berdasarkan ID
    $gaji = Gaji::findOrFail($id);

    // Periksa apakah gaji tersebut milik pengguna yang sedang login
    if ($gaji->user_id !== auth()->id()) {
        // Perbarui status gaji menjadi 'Lunas'
        $gaji->status = 'Lunas';
        $gaji->save();
    }



    // Redirect kembali ke daftar gaji dengan pesan sukses
    return redirect()->route('gaji')->with('success', 'Status gaji berhasil diperbarui.');
}


public function destroy($id)
{
    $gaji = Gaji::findOrFail($id);
    $gaji->delete();

    return redirect()->route('gaji')->with('success', 'Data gaji berhasil dihapus.');
}


}
