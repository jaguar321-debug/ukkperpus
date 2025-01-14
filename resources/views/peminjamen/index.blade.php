<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Peminjaman') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        @if(Auth::user()->role === 'user')
        <a href="{{ route('peminjamen.create') }}" class="btn btn-primary mb-3">Tambah</a>
        @endif

        <style>
            table thead tr {
                border-top: none;
            }

            table thead th {
                border-left: none;
                border-right: none;
            }
        </style>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status Peminjaman</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjamen as $peminjaman)
                    <tr>
                        <td>{{ $peminjaman->id }}</td>
                        <td>{{ $peminjaman->user->name }}</td>
                        <td>{{ $peminjaman->buku->judul }}</td>
                        <td>{{ $peminjaman->tanggal_peminjaman }}</td>
                        <td>{{ $peminjaman->tanggal_pengembalian }}</td>
                        <td> <span class="badge bg-primary">{{ $peminjaman->status_peminjaman }}</span></td>
                        @if(Auth::user()->role === 'user' || Auth::user()->role === 'petugas')
                        <td>
                            <a href="{{ route('peminjamen.edit', $peminjaman->id) }}" class="bi bi-pencil text-warning"></a>
                            <form action="{{ route('peminjamen.destroy', $peminjaman->id) }}" method="POST"
                                style="display:inline-block;"
                                onsubmit="return confirm('Apakah Kamu Yakin Ingin Hapus Data?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                class="text-red-600 hover:text-red-800 transition duration-150 ease-in-out">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                    @endif
                    </tr>
                    @endforeach
</x-app-layout>
