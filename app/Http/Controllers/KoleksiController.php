<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Koleksi;
use App\Models\User;
use Illuminate\Http\Request;

class KoleksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bukus = Buku::all();
        $users = User::all();
        $koleksis = Koleksi::with('buku', 'user')->get();
        return view('koleksis.index', compact('koleksis','bukus','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bukus = Buku::all();
        $users = User::all();
        return view('koleksis.create', compact('bukus','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'buku_id' => 'required',
        ], [
            'user_id.required' => 'User tidak boleh kosong',
            'buku_id.required' => 'Buku tidak boleh kosong',
        ]);

        // Simpan data
        Koleksi::create($request->all());

        // Redirect jika berhasil
        return redirect()->route('koleksis.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(koleksi $koleksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(koleksi $koleksi)
    {
        $users = User::all();
        $bukus = Buku::all();
        return view('koleksis.edit', compact('koleksi', 'bukus', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, koleksi $koleksi)
    {
        $request->validate([
            'user_id' => 'required',
            'buku_id' => 'required',
        ], [
            'user_id.required' => 'User tidak boleh kosong',
            'buku_id.required' => 'Buku tidak boleh kosong',
        ]);

        $koleksi->update($request->all());
        return redirect()->route('koleksis.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(koleksi $koleksi)
    {
        $koleksi->delete();
        return redirect()->route('koleksis.index')->with('success', 'jadwal dihapus dan ID diurutkan ulang dengan sukses.');
    }
}
