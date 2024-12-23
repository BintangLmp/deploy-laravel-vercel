@extends('components.layout')

@section('title', 'Pengaduan')

@section('content')
    <main id="main" class="mt-2">

        <section class="inner-page">
            <div class="container">
                <div class="title mb-5 text-center">
                    <h3 class="fw-bold">Layanan Pengaduan Pelanggan</h3>
                    <h5 class="fw-normal">Sampaikan laporan Anda langsung kepada instansi pemerintah berwenang</h5>
                </div>
                <div class="card card-responsive col-md-8 mx-auto rounded border-0 p-4 shadow">
                    <form action="{{ route('pelanggan.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="judul_laporan" class="form-label">Judul Laporan</label>
                            <input type="text" value="{{ old('judul_laporan') }}" name="judul_laporan" id="judul_laporan"
                                placeholder="Ketik Judul Pengaduan"
                                class="form-control @error('judul_laporan') is-invalid @enderror" required>
                            @error('judul_laporan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="isi_laporan" class="form-label">Isi Laporan</label>
                            <textarea name="isi_laporan" id="isi_laporan" placeholder="Ketik isi Pengaduan" rows="5"
                                class="form-control @error('isi_laporan') is-invalid @enderror" required>{{ old('isi_laporan') }}</textarea>
                            @error('isi_laporan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tgl_kejadian" class="form-label">Tanggal Kejadian</label>
                            <input type="date" value="{{ old('tgl_kejadian') }}" name="tgl_kejadian" id="tgl_kejadian"
                                placeholder="Tanggal Kejadian"
                                class="form-control @error('tgl_kejadian') is-invalid @enderror" required>
                            @error('tgl_kejadian')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="lokasi_kejadian" class="form-label">Lokasi Kejadian</label>
                            <textarea name="lokasi_kejadian" id="lokasi_kejadian" placeholder="Ketik Lokasi Kejadian" rows="3"
                                class="form-control @error('lokasi_kejadian') is-invalid @enderror" required>{{ old('lokasi_kejadian') }}</textarea>
                            @error('lokasi_kejadian')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="foto" class="form-label">Foto Bukti</label>
                            <input type="file" name="foto" id="foto"
                                class="form-control @error('file') is-invalid @enderror" required>
                            @error('file')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">KIRIM</button>

                    </form>
                </div>
            </div>
        </section>

    </main>
@endsection
@push('addon-script')
    <script>
        @if (!auth()->check())
            Swal.fire({
                title: 'Peringatan!',
                text: "Anda harus login terlebih dahulu!",
                icon: 'warning',
                confirmButtonColor: '#28B7B5',
                confirmButtonText: 'Masuk',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route('login') }}';
                }
            });
        @endif
    </script>
    
@endpush
