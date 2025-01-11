<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bukus = Buku::all();
        return view('bukus.index', compact('bukus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bukus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
        ], [
            'judul.required' => 'Judul tidak boleh kosong',
            'penulis.required' => 'Penulis tidak boleh kosong',
            'penerbit.required' => 'Penerbit tidak boleh kosong',
            'tahun_terbit.required' => 'Tahun terbit tidak boleh kosong',
        ]);

        // Simpan data
        Buku::create($request->all());

        // Redirect jika berhasil
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(buku $buku)
    {
        return view('bukus.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, buku $buku)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
        ], [
            'judul.required' => 'Judul tidak boleh kosong',
            'penulis.required' => 'Penulis tidak boleh kosong',
            'penerbit.required' => 'Penerbit tidak boleh kosong',
            'tahun_terbit.required' => 'Tahun terbit tidak boleh kosong',
        ]);
        $buku->update($request->all());
        return redirect()->route('bukus.index')->with('success', 'berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(buku $buku)
    {
        $buku->delete();
        $this->reorderIds();
        return redirect()->route('bukus.index')->with('success', 'Buku dihapus dan NO diurutkan ulang dengan sukses.');
    }

    public function reorderIds()
    {
        $bukus = Buku::orderBy('id')->get();
        $counter = 1;

        foreach ($bukus as $buku) {
            $buku->id = $counter++;
            $buku->save();
        }

        // Setel ulang nilai auto-increment ke ID tertinggi + 1
        DB::statement('ALTER TABLE bukus AUTO_INCREMENT = ' . ($counter));
    }
}
