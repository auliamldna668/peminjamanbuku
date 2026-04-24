<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    /**
     * Tampilkan daftar peminjaman user
     */
  public function index()
{
    $anggota = Anggota::where('user_id', Auth::id())->first();

    // <-- TARUH DI SINI

    if (!$anggota) {
        return redirect('/user/dashboard')
            ->with('error', 'Data anggota belum tersedia');
    }

    $peminjamans = Peminjaman::where('anggota_id', $anggota->id)
        ->with('buku')
        ->get();

    return view('User.Peminjaman.index', compact('peminjamans'));
}

    /**
     * Form peminjaman buku
     */
    public function create($id)
    {
        $buku = Buku::findOrFail($id);

        return view('User.Peminjaman.create', compact('buku'));
    }

    /**
     * Simpan data peminjaman
     */
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $anggota = Anggota::where('user_id', Auth::id())->first();

        if (!$anggota) {
            return back()->with('error', 'Data anggota tidak ditemukan');
        }

        $buku = Buku::findOrFail($request->buku_id);

        // Cek stok
        if ($buku->stok < $request->jumlah) {
            return back()->with('error', 'Stok buku tidak cukup');
        }

        // Cek apakah sudah meminjam buku yang sama
        $sudahPinjam = Peminjaman::where('anggota_id', $anggota->id)
            ->where('buku_id', $buku->id)
            ->where('status', 'menunggu')
            ->exists();

        if ($sudahPinjam) {
            return back()->with('error', 'Kamu sudah meminjam buku ini');
        }

        // Simpan peminjaman
       Peminjaman::create([
    'anggota_id' => $anggota->id,
    'buku_id' => $buku->id,
    'jumlah' => $request->jumlah,
    'tanggal_pinjam' => Carbon::now(),
    'tanggal_kembali' => Carbon::now()->addDays(7), // ✅ ganti ini
    'status' => 'menunggu',

        ]);

        // Kurangi stok
        $buku->decrement('stok', $request->jumlah);

        return redirect()->route('user.peminjaman.index')
            ->with('success', 'Buku berhasil dipinjam');
    }

    /**
     * Proses pengembalian buku
     */
  public function kembali($id)
{
    $anggota = Anggota::where('user_id', Auth::id())->first();

    if (!$anggota) {
        return back()->with('error', 'Data anggota tidak ditemukan');
    }

    $pinjam = Peminjaman::where('id', $id)
        ->where('anggota_id', $anggota->id)
        ->firstOrFail();

    // Hitung denda dari tanggal_kembali
    $batasWaktu = Carbon::parse($pinjam->tanggal_kembali)->startOfDay();
    $sekarang = Carbon::now()->startOfDay();
    $hariTelat = $sekarang->diffInDays($batasWaktu, false); // negatif = telat
    $hariTelat = $hariTelat < 0 ? abs($hariTelat) : 0;
    $totalDenda = $hariTelat * 1000; // Rp 1.000/hari

    $pinjam->update([
        'tanggal_kembali_aktual' => Carbon::now(),
        'status' => 'kembali',
        'denda' => $totalDenda,
    ]);

    if ($pinjam->buku) {
        $pinjam->buku->increment('stok', $pinjam->jumlah);
    }

    return back()->with('success', 'Buku dikembalikan. Denda: Rp ' . number_format($totalDenda, 0, ',', '.'));
}
}