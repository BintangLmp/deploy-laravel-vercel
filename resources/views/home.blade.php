@extends('components.layout')

@section('title', 'Home')

@section('content')
    <section id="jsn" class="d-flex align-items-center">
        <div class="container">
            <h1>Pengaduan Pelanggan</h1>
            <a href="{{ asset('login') }}"
                class="inline-block rounded-lg bg-blue-500 px-4 py-2 font-semibold text-white shadow-md transition duration-300 hover:bg-blue-600 mt-2">Buat
                Pengaduan</a>
        </div>
    </section>

    <section id="why-us" class="why-us">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 d-flex align-items-stretch">
                    <div class="icon-boxes d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-xl-3 col-md-6 d-flex align-items-stretch">
                                <div class="icon-box mt-xl-0 mt-4 text-center">
                                    <i class="bx bxs-megaphone"></i>
                                    <h4>Tulis Pengaduan</h4>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 d-flex align-items-stretch">
                                <div class="icon-box mt-xl-0 mt-4 text-center">
                                    <i class="bx bx-analyse"></i>
                                    <h4>Proses Verifikasi</h4>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 d-flex align-items-stretch">
                                <div class="icon-box mt-xl-0 mt-4 text-center">
                                    <i class="bx bx-cube-alt"></i>
                                    <h4>Tindak Lanjut</h4>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 d-flex align-items-stretch">
                                <div class="icon-box mt-xl-0 mt-4 text-center">
                                    <i class='bx bx-check-circle'></i>
                                    <h4>Selesai</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="counts" class="counts">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-6 col-sm-4 mb-4 text-center">
                    <div class="count-box">
                        <i class='bx bx-list-check'></i>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $pengaduanCount ?? 0 }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Semua Pengaduan</p>
                    </div>
                </div>

                <div class="col-6 col-sm-4 mb-4 text-center">
                    <div class="count-box">
                        <i class='bx bx-loader'></i>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $prosesCount ?? 0 }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Sedang Diproses</p>
                    </div>
                </div>

                <div class="col-6 col-sm-4 mb-4 text-center">
                    <div class="count-box">
                        <i class='bx bx-check-circle'></i>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $selesaiCount ?? 0 }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Selesai</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
