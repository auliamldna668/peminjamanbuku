<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('anggota','buku')->get();
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    
// PeminjamanController.php
public function approve($id)
{
    Peminjaman::where('id', $id)->update([
        'status' => 'dipinjam' // sesuai ENUM yang ada
    ]);

    return back()->with('success', 'Peminjaman disetujui');
}


public function reject($id)
{
    $peminjaman = Peminjaman::findOrFail($id);
    $peminjaman->update(['status' => 'ditolak']);

    return redirect()->back()->with('success', 'Peminjaman ditolak');
}


    public function store(Request $request)
    {
        Peminjaman::create([
            'anggota_id' => $request->anggota_id,
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'status' => 'dipinjam'
        ]);

        return redirect('/peminjaman');
    }

    public function kembalikan($id)
{
    $peminjaman = Peminjaman::findOrFail($id);

    // Hitung denda dari tanggal_kembali
    $batasWaktu = Carbon::parse($peminjaman->tanggal_kembali)->startOfDay();
    $sekarang = Carbon::now()->startOfDay();
    $hariTelat = $sekarang->diffInDays($batasWaktu, false);
    $hariTelat = $hariTelat < 0 ? abs($hariTelat) : 0;
    $totalDenda = $hariTelat * 1000;

    $peminjaman->update([
        'tanggal_kembali_aktual' => Carbon::now(),
        'status' => 'kembali',
        'denda' => $totalDenda,
    ]);

    if ($peminjaman->buku) {
        $peminjaman->buku->increment('stok', $peminjaman->jumlah);
    }

    return back()->with('success', 'Buku dikembalikan. Denda: Rp ' . number_format($totalDenda, 0, ',', '.'));
}
}