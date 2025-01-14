<x-app-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <!-- Header Card -->
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h5 class="mb-0 d-flex align-items-center justify-content-center">
                            <i class="bi bi-person-plus me-2"></i>
                            Form Tambah Koleksi
                        </h5>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('koleksis.store') }}">
                            @csrf
                            <!-- Grid untuk Judul dan Penulis -->
                            <div class="row mb-3">
                                <!-- Judul Field -->
                                <div class="col-md-6">
                                    <label for="buku_id">Buku</label>
                                    <select class="form-control @error('buku_id') is-invalid @enderror" name="buku_id" id="buku_id">
                                        <option disabled selected>-- Pilih Buku --</option>
                                        @foreach ($bukus as $buku)
                                            <option value="{{ $buku->id }}" {{ old('buku_id') == $buku->id ? 'selected' : '' }}>
                                                {{ $buku->judul }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('buku_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Buttons -->
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('koleksis.index') }}"
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
