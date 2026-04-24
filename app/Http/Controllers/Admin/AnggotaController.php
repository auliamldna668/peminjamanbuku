<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;

class AnggotaController extends Controller
{
    public function index()
    {$anggotas = Anggota::all();
return view('admin.anggota.index', compact('anggotas'));
    }

    public function create()
    {
        return view('admin.anggota.create');
    }

  public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'email' => 'required|email',
        'role' => 'required',
    ]);

    Anggota::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'role' => $request->role,
    ]);

    return redirect()->route('admin.anggota.index')
        ->with('success', 'Data berhasil ditambah');
}
    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('admin.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
{
    $anggota = Anggota::findOrFail($id);

    $request->validate([
        'nama' => 'required',
        'email' => 'required|email',
        'role' => 'required',
    ]);

    $anggota->update([
        'nama' => $request->nama,
        'email' => $request->email,
        'role' => $request->role,
    ]);

    return redirect()->route('admin.anggota.index')
        ->with('success', 'Data berhasil diupdate');
}
    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Anggota berhasil dihapus');
    }

    
}