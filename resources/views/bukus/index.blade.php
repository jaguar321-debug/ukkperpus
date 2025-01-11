<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Buku') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <a href="{{ route('bukus.create') }}" class="btn btn-primary mb-3">Tambah</a>

        <style>
            table thead tr {
                border-top: none;
            }

            table thead th {
                border-left: none;
                border-right: none;
            }
        </style>

        <!-- Tabel Buku --> 
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bukus as $buku)
                    <tr>
                        <td>{{ $buku->id }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ $buku->penerbit }}</td>
                        <td>{{ $buku->tahun_terbit }}</td>
                        <td>
                            <!-- Tombol Edit -->
                            <a href="{{ route('bukus.edit', $buku->id) }}"
                                class="bi bi-pencil text-warning"></a>
                                
                            <!-- Form Hapus -->
                            <form action="{{ route('bukus.destroy', $buku->id) }}" method="POST"
                                style="display:inline-block;" onsubmit="return confirm('Apakah Kamu Yakin Ingin Hapus Data?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-600 hover:text-red-800 transition duration-150 ease-in-out">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
