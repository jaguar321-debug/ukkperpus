<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bukus = Buku::all();
        $users = User::all();
        $ulasans = Ulasan::with('buku', 'user')->get();
        return view('ulasans.index', compact('ulasans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bukus = Buku::all();
        $users = User::all();
        return view('ulasans.create', compact('bukus','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required',
            'rating' => 'required',
            'ulasan' => 'required',
        ], [
            'buku_id.required' => 'Buku tidak boleh kosong',
            'rating.required' => 'Rating tidak boleh kosong',
            'ulasan.required' => 'Komentar tidak boleh kosong',
        ]);

        // Simpan data
        Ulasan::create([
            'user_id' => Auth::id(), // Mengambil ID user yang sedang login
            'buku_id' => $request->buku_id,
            'rating' => $request->rating,
            'ulasan' => $request->ulasan,
        ]);

        // Redirect jika berhasil
        return redirect()->route('ulasans.index')->with('success', 'Ulasan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ulasan $ulasan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ulasan $ulasan)
    {
        $users = User::all();
        $bukus = Buku::all();
        return view('ulasans.edit', compact('ulasan', 'bukus', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ulasan $ulasan)
    {
        $request->validate([
            'user_id' => 'required',
            'buku_id' => 'required',
        ], [
            'user_id.required' => 'User tidak boleh kosong',
            'buku_id.required' => 'Buku tidak boleh kosong',
        ]);

        $ulasan->update($request->all());
        return redirect()->route('ulasans.index')->with('success', 'Pengguna berhasil diedit.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ulasan $ulasan)
    {
        $ulasan->delete();
        $this->reorderIds();
        return redirect()->route('ulasans.index')->with('success', 'jadwal dihapus dan ID diurutkan ulang dengan sukses.');
    }

    public function reorderIds()
    {
        $ulasans = Ulasan::orderBy('id')->get();
        $counter = 1;

        foreach ($ulasans as $ulasan) {
            $ulasan->id = $counter++;
            $ulasan->save();
        }

        // Setel ulang nilai auto-increment ke ID tertinggi + 1
        DB::statement('ALTER TABLE ulasans AUTO_INCREMENT = ' . ($counter));
    }
}
