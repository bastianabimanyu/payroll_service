<?php

namespace App\Http\Controllers\User;

use App\Models\Gaji;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf; // Import DomPDF

class UserController extends Controller
{
    public function index()
    {
        // Ambil semua data gaji yang berhubungan dengan user yang sedang login
        $gajis = Gaji::where('user_id', auth()->id())->latest()->get();

        // Mengirim data gaji ke view
        return view('dashboard', compact('gajis'));
    }

    public function exportPdf()
    {
        // Ambil data gaji user yang sedang login
        $gajis = Gaji::where('user_id', auth()->id())->latest()->get();

        // Load view untuk PDF
        $pdf = Pdf::loadView('exports.gajipdf', compact('gajis'));

        // Download PDF
        return $pdf->download('riwayat-gaji.pdf');
    }
}
