<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Datakaryawan;
use Illuminate\Http\Request;

class DatakaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $karyawan = Datakaryawan::latest()->get();
        // Mengirim data karyawan ke view 
        return view('admin.datakaryawan', compact('karyawan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:50',
            'email' => 'required|email',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'jabatan' => 'nullable|string|max:100',
            'tanggal_masuk' => 'nullable|date',
            'gaji_pokok' => 'nullable|numeric',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        Datakaryawan::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'jabatan' => $request->jabatan,
            'tanggal_masuk' => $request->tanggal_masuk,
            'gaji_pokok' => $request->gaji_pokok,
            'status' => $request->status,
        ]);

        return redirect()->route('datakaryawan.index')->with(['success', 'Data karyawan berhasil disimpan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $karyawan = Datakaryawan::findOrFail($id);

        return view('admin.editdatakaryawan', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'nik' => 'required|string|max:50',
        'email' => 'required|email|max:255',
        'no_hp' => 'nullable|string|max:20',
        'alamat' => 'nullable|string|max:255',
        'jabatan' => 'nullable|string|max:100',
        'tanggal_masuk' => 'nullable|date',
        'gaji_pokok' => 'nullable|numeric',
        'status' => 'required|in:Aktif,Tidak Aktif',
    ]);

    // Cari data karyawan berdasarkan ID
    $karyawan = DataKaryawan::findOrFail($id);

    // Update data
    $karyawan->update([
        'nama' => $request->nama,
        'nik' => $request->nik,
        'email' => $request->email,
        'no_hp' => $request->no_hp, 
        'alamat' => $request->alamat,
        'jabatan' => $request->jabatan,
        'tanggal_masuk' => $request->tanggal_masuk,
        'gaji_pokok' => $request->gaji_pokok,
        'status' => $request->status,
    ]);

    // Redirect kembali ke halaman index dengan pesan sukses
    return redirect()->route('datakaryawan.index')->with('success', 'Data karyawan berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deletedata = Datakaryawan::findOrFail($id);

        $deletedata->delete();

        return redirect()->route('datakaryawan.index')->with('success', 'Data Berhasil Dihapus');
    }
}
