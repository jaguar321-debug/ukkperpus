<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Daftar Buku') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('bukukategoris.create') }}" class="btn btn-primary mb-3">Tambah</a>
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
                    <th>Buku</th>
                    <th>Kategori</th>
                    @if(Auth::user()->role === 'admin')
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($bukukategoris as $bukukategori)
                    <tr>
                        <td>{{ $bukukategori->id }}</td>
                        <td>{{ $bukukategori->buku->judul }}</td>
                        <td>{{ $bukukategori->kategori->nama_kategori }}</td>
                        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'petugas')
                            <td>
                                <a href="{{ route('bukukategoris.edit', $bukukategori->id) }}" class="bi bi-pencil text-warning"></a>
                                <form action="{{ route('bukukategoris.destroy', $bukukategori->id) }}" method="POST"
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
            </tbody>
        </table>
    </div>
</x-app-layout>
