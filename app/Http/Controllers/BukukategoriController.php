<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Bukukategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukukategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bukukategoris = Bukukategori::with('buku', 'kategori')->get();
        $bukus = Buku::all();
        $kategoris = Kategori::all();
        return view('bukukategoris.index', compact('bukukategoris','bukus','kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bukus = Buku::all();
        $kategoris = Kategori::all();
        return view('bukukategoris.create', compact('bukus', 'kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required',
            'kategori_id' => 'required',
        ], [
            'buku_id.required' => 'Buku tidak boleh kosong',
            'kategori_id.required' => 'Kategori tidak boleh kosong',
        ]);

        // Simpan data
        Bukukategori::create($request->all());

        // Redirect jika berhasil
        return redirect()->route('bukukategoris.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(bukukategori $bukukategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bukukategori $bukukategori)
    {
        $bukus = Buku::all();
        $kategoris = Kategori::all();
        return view('bukukategoris.edit', compact('bukukategori', 'bukus', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, bukukategori $bukukategori)
    {
        $request->validate([
            'buku_id' => 'required',
            'kategori_id' => 'required',
        ], [
            'buku_id.required' => 'Buku tidak boleh kosong',
            'kategori_id.required' => 'Kategori tidak boleh kosong',
        ]);

        $bukukategori->update($request->all());
        return redirect()->route('bukukategoris.index')->with('success', 'berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bukukategori $bukukategori)
    {
        $bukukategori->delete();
        $this->reorderIds();
        return redirect()->route('bukukategoris.index')->with('success', 'jadwal dihapus dan ID diurutkan ulang dengan sukses.');
    }

    public function reorderIds()
    {
        $bukukategoris = Bukukategori::orderBy('id')->get();
        $counter = 1;

        foreach ($bukukategoris as $data) {
            $data->id = $counter++;
            $data->save();
        }

        // Setel ulang nilai auto-increment ke ID tertinggi + 1
        DB::statement('ALTER TABLE bukukategoris AUTO_INCREMENT = ' . ($counter));
    }
}
