<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjamen = Peminjaman::with('buku', 'user')->get();
        $bukus = Buku::all();
        $users = User::all();
        return view('peminjamen.index', compact('peminjamen','bukus','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bukus = Buku::all();
        $users = User::all();
        return view('peminjamen.create', compact('bukus','users'));
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
        Peminjaman::create($request->all());

        // Redirect jika berhasil
        return redirect()->route('peminjamen.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(peminjaman $peminjaman)
    {
        $users = User::all();
        $bukus = Buku::all();
        return view('peminjamen.edit', compact('peminjaman', 'bukus', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, peminjaman $peminjaman)
    {
        $request->validate([
            'user_id' => 'required',
            'buku_id' => 'required',
        ], [
            'user_id.required' => 'User tidak boleh kosong',
            'buku_id.required' => 'Buku tidak boleh kosong',
        ]);

        $peminjaman->update($request->all());
        return redirect()->route('peminjamen.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(peminjaman $peminjaman)
    {
        $peminjaman->delete();
        return redirect()->route('peminjamen.index')->with('success', 'jadwal dihapus dan ID diurutkan ulang dengan sukses.');
    }
}
