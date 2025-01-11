<x-app-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <!-- Header Card -->
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h5 class="mb-0 d-flex align-items-center justify-content-center">
                            <i class="bi bi-person-plus me-2"></i>
                            Form Tambah Kategori
                        </h5>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('kategoris.store') }}">
                            @csrf
                            <!-- Grid untuk Judul dan Penulis -->
                            <div class="row mb-3">
                                <div class="mb-3 position-relative">
                                    <label for="nama_kategori">Kategori</label>
                                    <input type="text" id="nama_kategori" name="nama_kategori"
                                        value="{{ old('nama_kategori') }}"
                                        class="form-control @error('nama_kategori') is-invalid @enderror">
                                    @error('nama_kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>  
                            </div>
                            <!-- Buttons -->
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('kategoris.index') }}"
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
