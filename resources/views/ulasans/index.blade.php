<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Ulasan') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        @if(Auth::user()->role === 'user')
        <a href="{{ route('ulasans.create') }}" class="btn btn-primary mb-3">Tambah</a>
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
        <table class="table table-bordered  table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th>Rating</th>
                    <th>Ulasan</th>
                    @if(Auth::user()->role === 'user')
                    <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($ulasans as $ulasan)
                    <tr>
                        <td>{{ $ulasan->id }}</td>
                        <td>{{ $ulasan->user->name }}</td>
                        <td>{{ $ulasan->buku->judul }}</td>
                        <td>{{ $ulasan->rating }}</td>
                        <td>{{ $ulasan->ulasan }}</td>
                        @if(Auth::user()->role === 'user')
                        <td>
                            <a href="{{ route('ulasans.edit', $ulasan->id) }}" class="bi bi-pencil text-warning"></a>
                            <form action="{{ route('ulasans.destroy', $ulasan->id) }}" method="POST"
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
