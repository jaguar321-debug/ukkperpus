<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
            'buku_id' => 'required',
            'tanggal_peminjaman' => 'required',
            'tanggal_pengembalian' => 'required',
            'status_peminjaman' => 'required',
        ], [
            'buku_id.required' => 'Buku tidak boleh kosong',
            'tanggal_peminjaman.required' => 'Buku tidak boleh kosong',
            'tanggal_pengembalian.required' => 'Buku tidak boleh kosong',
            'status_peminjaman.required' => 'Buku tidak boleh kosong',
        ]);

        // Simpan data
        Peminjaman::create([
            'user_id' => Auth::id(), // Mengambil ID user yang sedang login
            'buku_id' => $request->buku_id,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'status_peminjaman' => $request->status_peminjaman,
        ]);

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
            'buku_id' => 'required',
            'tanggal_peminjaman' => 'required',
            'tanggal_pengembalian' => 'required',
            'status_peminjaman' => 'required',
        ], [
            'buku_id.required' => 'Buku tidak boleh kosong',
            'tanggal_peminjaman.required' => 'Tanggal Pinjam tidak boleh kosong',
            'tanggal_pengembalian.required' => 'Tanggal Kembali tidak boleh kosong',
            'status_peminjaman.required' => 'Status tidak boleh kosong',
        ]);

        $peminjaman->update([
            'buku_id' => $request->buku_id,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'status_peminjaman' => $request->status_peminjaman,
        ]);
        return redirect()->route('peminjamen.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(peminjaman $peminjaman)
    {
        $peminjaman->delete();
        $this->reorderIds();
        return redirect()->route('peminjamen.index')->with('success', 'jadwal dihapus dan ID diurutkan ulang dengan sukses.');
    }

    public function reorderIds()
    {
        $peminjamen = Peminjaman::orderBy('id')->get();
        $counter = 1;

        foreach ($peminjamen as $peminjaman) {
            $peminjaman->id = $counter++;
            $peminjaman->save();
        }

        // Setel ulang nilai auto-increment ke ID tertinggi + 1
        DB::statement('ALTER TABLE peminjamen AUTO_INCREMENT = ' . ($counter));
    }
}
