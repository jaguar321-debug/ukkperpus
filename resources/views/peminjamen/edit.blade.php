<x-app-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <!-- Header Card -->
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h5 class="mb-0 d-flex align-items-center justify-content-center">
                            <i class="bi bi-person-gear me-2"></i>
                            Form Edit Ulasan
                        </h5>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="{{ route('peminjamen.update', $peminjaman->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Grid untuk Judul dan Penulis -->
                            <div class="row mb-3">
                                <!-- Judul Field -->
                                <div class="col-md-6">
                                    <label for="buku_id">Buku</label>
                                    <select class="form-control @error('buku_id') is-invalid @enderror" name="buku_id"
                                        id="buku_id" required>
                                        <option value="" disabled>-- Pilih Pemilik --</option>
                                        @foreach ($bukus as $buku)
                                            <option value="{{ $buku->id }}"
                                                {{ old('buku_id', $peminjaman->buku_id) == $buku->id ? 'selected' : '' }}>
                                                {{ $buku->judul }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('buku_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Judul Field -->
                                <div class="col-md-6">
                                    <label for="tanggal_peminjaman">Tanggal Pinjam</label>
                                    <input type="date" id="tanggal_peminjaman" name="tanggal_peminjaman"
                                        value="{{ old('tanggal_peminjaman', $peminjaman->tanggal_peminjaman) }}"
                                        class="form-control @error('tanggal_peminjaman') is-invalid @enderror">
                                    @error('tanggal_peminjaman')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Judul Field -->
                                <div class="col-md-6">
                                    <label for="tanggal_pengembalian">Tanggal Kembali</label>
                                    <input type="date" id="tanggal_pengembalian" name="tanggal_pengembalian"
                                        value="{{ old('tanggal_pengembalian', $peminjaman->tanggal_pengembalian) }}"
                                        class="form-control @error('tanggal_pengembalian') is-invalid @enderror">
                                    @error('tanggal_pengembalian')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="status_peminjaman">Status</label>
                                    <input type="text" id="status_peminjaman" name="status_peminjaman"
                                        value="{{ old('status_peminjaman', $peminjaman->status_peminjaman) }}"
                                        class="form-control @error('status_peminjaman') is-invalid @enderror">
                                    @error('status_peminjaman')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Buttons -->
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('peminjamen.index') }}"
                                    class="btn btn-secondary me-2 d-flex align-items-center">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary d-flex align-items-center">
                                    <i class="bi bi-save me-1"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
