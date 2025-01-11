<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Kategori') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <a href="{{ route('kategoris.create') }}" class="btn btn-primary mb-3">Tambah</a>

        <style>
            table thead tr {
                border-top: none;
            }

            table thead th {
                border-left: none;
                border-right: none;
            }
        </style>
        <table class="table table-bordered  table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategoris as $kategori)
                    <tr>
                        <td>{{ $kategori->id }}</td>
                        <td>{{ $kategori->nama_kategori }}</td>
                        <td>
                            
                                <a href="{{ route('kategoris.edit', $kategori->id) }}"
                                    class="bi bi-pencil text-warning"></a>
                            <form action="{{ route('kategoris.destroy', $kategori->id) }}" method="POST"
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
                    </tr>

                    
                @endforeach
            </tbody>
        </table>
    </div>

    
</x-app-layout>
