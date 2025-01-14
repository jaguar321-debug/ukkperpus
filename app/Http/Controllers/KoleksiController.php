<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Koleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KoleksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil ulasan dengan relasi user dan buku
        $koleksis = Koleksi::with('buku', 'user')->get();
        return view('koleksis.index', compact('koleksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Hanya menampilkan buku di form
        $bukus = Buku::all();
        return view('koleksis.create', compact('bukus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required',
        ], [
            'buku_id.required' => 'Buku tidak boleh kosong',
        ]);

        // Simpan data dengan user_id dari user yang sedang login
        Koleksi::create([
            'user_id' => Auth::id(), // Mengambil ID user yang sedang login
            'buku_id' => $request->buku_id,
        ]);

        return redirect()->route('koleksis.index')->with('success', 'Ulasan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Koleksi $koleksi)
    {
        $bukus = Buku::all();
        return view('koleksis.edit', compact('koleksi', 'bukus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Koleksi $koleksi)
    {
        $request->validate([
            'buku_id' => 'required',
        ], [
            'buku_id.required' => 'Buku tidak boleh kosong',
        ]);

        $koleksi->update([
            'buku_id' => $request->buku_id,
        ]);

        return redirect()->route('koleksis.index')->with('success', 'Ulasan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Koleksi $koleksi)
    {
        $koleksi->delete();
        $this->reorderIds();
        return redirect()->route('koleksis.index')->with('success', 'Ulasan dihapus dan ID diurutkan ulang.');
    }

    public function reorderIds()
    {
        $koleksis = Koleksi::orderBy('id')->get();
        $counter = 1;

        foreach ($koleksis as $koleksi) {
            $koleksi->id = $counter++;
            $koleksi->save();
        }

        DB::statement('ALTER TABLE koleksis AUTO_INCREMENT = ' . ($counter));
    }
}
