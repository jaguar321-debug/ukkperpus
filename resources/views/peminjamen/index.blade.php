<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Daftar Buku') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Tambah</button>

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
                        <td>{{ $peminjaman->tanggal_peminjaman }}</td>
                        <td>{{ $peminjaman->tanggal_pengembalian }}</td>
                        <td>{{ $peminjaman->status_peminjaman }}</td>
                        <td>
                            <button class="bi bi-pencil text-warning" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $peminjaman->id }}"></button>
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
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal{{ $peminjaman->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Buku</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('peminjamen.update', $peminjaman->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="buku_id" class="form-label">Buku</label>
                                            <select class="form-select" id="buku_id" name="buku_id" required>
                                                @foreach ($bukus as $buku)
                                                    <option value="{{ $buku->id }}"
                                                        {{ old('buku_id', $peminjaman->buku_id) == $buku->id ? 'selected' : '' }}>
                                                        {{ $buku->judul }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('peminjamen.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="buku_id" class="form-label">Buku</label>
                            <select class="form-select" id="buku_id" name="buku_id" required>
                                <option value="" disabled selected>Pilih Buku</option>
                                @foreach ($bukus as $buku)
                                    <option value="{{ $buku->id }}"
                                        {{ old('buku_id') == $buku->id ? 'selected' : '' }}>
                                        {{ $buku->judul }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
