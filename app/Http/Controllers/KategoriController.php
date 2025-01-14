<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::all();
        return view('kategoris.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategoris.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ], [
            'nama_kategori.required' => 'Kategori tidak boleh kosong',
        ]);

        // Simpan data
        Kategori::create($request->all());

        // Redirect jika berhasil
        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kategori $kategori)
    {
        return view('kategoris.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ], [
            'nama_kategori.required' => 'Kategori tidak boleh kosong',
        ]);

        $kategori->update($request->all());
        return redirect()->route('kategoris.index')->with('success', 'berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kategori $kategori)
    {
        $kategori->delete();
        $this->reorderIds();
        return redirect()->route('kategoris.index')->with('success', 'jadwal dihapus dan ID diurutkan ulang dengan sukses.');
    }

    public function reorderIds()
    {
        $kategoris = Kategori::orderBy('id')->get();
        $counter = 1;

        foreach ($kategoris as $kategori) {
            $kategori->id = $counter++;
            $kategori->save();
        }

        // Setel ulang nilai auto-increment ke ID tertinggi + 1
        DB::statement('ALTER TABLE kategoris AUTO_INCREMENT = ' . ($counter));
    }
}
