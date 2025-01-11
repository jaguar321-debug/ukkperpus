<x-app-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <!-- Header Card -->
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h5 class="mb-0 d-flex align-items-center justify-content-center">
                            <i class="bi bi-person-plus me-2"></i>
                            Form Tambah Buku
                        </h5>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('bukus.store') }}">
                            @csrf
                            <!-- Grid untuk Judul dan Penulis -->
                            <div class="row mb-3">
                                <!-- Judul Field -->
                                <div class="col-md-6">
                                    <label for="judul">Judul</label>
                                    <div class="mb-3 position-relative">
                                        <input type="text" id="judul" name="judul" value="{{ old('judul') }}"
                                            class="form-control @error('judul') is-invalid @enderror">
                                        @error('judul')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Penulis Field -->
                                <div class="col-md-6">
                                    <label for="penulis">Penulis</label>
                                    <div class="mb-3 position-relative">
                                        <input type="text" id="penulis" name="penulis" value="{{ old('penulis') }}"
                                            class="form-control @error('penulis') is-invalid @enderror">
                                        @error('penulis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Grid untuk Penerbit dan Tahun Terbit -->
                            <div class="row mb-3">
                                <!-- Penerbit Field -->
                                <div class="col-md-6">
                                    <label for="penerbit">Penerbit</label>
                                    <div class="mb-3 position-relative">
                                        <input type="text" id="penerbit" name="penerbit" value="{{ old('penerbit') }}"
                                            class="form-control @error('penerbit') is-invalid @enderror">
                                        @error('penerbit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Tahun Terbit Field -->
                                <div class="col-md-6">
                                    <label for="tahun_terbit">Tahun Terbit</label>
                                    <div class="mb-3 position-relative">
                                        <input type="number" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit') }}"
                                            class="form-control @error('tahun_terbit') is-invalid @enderror" min="1900" max="2099">
                                        @error('tahun_terbit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Buttons -->
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('bukus.index') }}" class="btn btn-secondary me-2 d-flex align-items-center">
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
