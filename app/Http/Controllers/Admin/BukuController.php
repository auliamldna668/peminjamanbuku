<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $buku = Buku::with('kategori')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('judul', 'like', "%$keyword%")
                      ->orWhere('penulis', 'like', "%$keyword%"); // ✅ fix
            })
            ->get();

        return view('admin.buku.index', compact('buku', 'keyword'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.buku.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoName = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fotoName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/buku'), $fotoName);
        }

        Buku::create([
    'judul' => $request->judul,
    'penulis' => $request->penulis,
    'penerbit' => $request->penerbit,
    'tahun' => $request->tahun,
    'stok' => $request->stok,
    'foto' => $fotoName,
    'kategori_id' => $request->kategori_id, // ✅ tambah ini
]);
        return redirect()->route('admin.buku.index');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.buku.edit', compact('buku', 'kategoris'));
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();
        return redirect('/admin/buku')->with('success', 'Data berhasil dihapus');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required', // ✅ fix
            'kategori_id' => 'required',
            'stok' => 'required|integer',
        ]);

        $buku = Buku::findOrFail($id);

        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,       // ✅ fix
            'kategori_id' => $request->kategori_id,
            'stok' => $request->stok,
        ]);

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil diupdate');
    }
}