@extends('frontend.layouts.app')
@push('css')
<style>
    @media (max-width: 767.98px) {
        .p-horizontal {
            text-align: justify;
        }
    }
</style>
@endpush
@section('content')
<header class="header-2 position-relative overflow-hidden">
    <div id="hero-slider" class="position-relative" style="height: 75vh; overflow: hidden;">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner mb-4">
                @foreach ($banners as $banner)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="page-header min-vh-75"
                        style="background-image: url('{{ asset('storage/' . $banner->foto) }}');">
                        <!--mask dihilangkan-->
                        <!--<span class="mask bg-gradient-dark"></span>-->
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 my-auto">
                                    <h1 class="text-white fadeIn2 fadeInBottom">{{ $banner->judul }}</h1>
                                    <p class="lead text-white opacity-8 fadeIn3 fadeInBottom">
                                        <strong>{{ $banner->deskripsi }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Tombol navigasi -->
            <div class="min-vh-75 position-absolute w-100 top-0">
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon position-absolute bottom-50" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon position-absolute bottom-50" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>

        <!-- Titik indikator -->
        @if($banners->count())
        <div id="hero-dots" class="position-absolute start-50 translate-middle-x d-flex gap-2" style="bottom: 90px;">

            @foreach ($banners as $index => $banner)
            <span class="dot rounded-circle bg-white {{ $index === 0 ? 'opacity-100' : 'opacity-50' }}"
                style="width:10px;height:10px;cursor:pointer;" data-slide="{{ $index }}">
            </span>
            @endforeach

        </div>
        @endif

    </div>
</header>


<div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">

    <section class="pt-3 pb-4" id="count-stats">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto py-3">
                    <div class="row">
                        @php
                        $total = $totalDonasiApproved ?? 0;
                        $display = 'Rp ' . number_format($total, 0, ',', '.'); // keep numeric formatting (if used)
                        @endphp

                        <div class="col-md-4 position-relative">
                            <div class="p-3 text-center">
                                {{-- data-raw berisi angka mentah untuk JS --}}
                                <h1 class="text-gradient text-dark"
                                    style="font-size: 2rem; font-weight: 700; margin-bottom: 4px;">
                                    <span id="state1" data-count="{{ $total }}" data-raw="{{ $total }}"
                                        style="font-size: 2rem;">
                                        {{ $display }}
                                    </span>
                                </h1>
                                <h5 class="mt-3">Total Donasi / Dukungan</h5>
                                <p class="text-sm font-weight-normal text-muted">
                                    Terima kasih—dukungan Anda memperkuat aktivitas dakwah dan program sosial Dewan
                                    Da’wah Risalah Islamiyyah.
                                </p>
                            </div>
                            <hr class="vertical dark">
                        </div>
                        <div class="col-md-4 position-relative">
                            <div class="p-3 text-center">
                                <h1 class="text-gradient text-dark">
                                    <span id="state2" data-count="{{ $articlesCount }}" data-raw="{{ $articlesCount }}">
                                        {{ $articlesCount }}
                                    </span>
                                </h1>
                                <h5 class="mt-3">Artikel / Publikasi</h5>
                                <p class="text-sm font-weight-normal">
                                    Terdapat publikasi dan materi dakwah yang membahas berbagai topik keagamaan dan
                                    sosial.
                                </p>
                            </div>
                            <hr class="vertical dark">
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 text-center">
                                <h1 class="text-gradient text-dark" id="state3" data-count="{{ $activitiesCount }}"
                                    data-raw="{{ $activitiesCount }}">{{ $activitiesCount }}</h1>
                                <h5 class="mt-3">Kegiatan</h5>
                                <p class="text-sm font-weight-normal">Berbagai kegiatan pendidikan, tabligh, dan program
                                    pemberdayaan masyarakat.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-12 my-auto">
                    <div class="info-horizontal border-radius-xl d-block d-md-flex p-4 h-100">
                        <div class="ps-0 ps-md-3 mt-3 mt-md-0">
                            <h5>Dakwah Dewan Risalah</h5>
                            <p class="p-horizontal">Dewan Da’wah Risalah Islamiyyah aktif menyelenggarakan kegiatan
                                dalam bidang pendidikan, keagamaan, ekonomi, sosial, dan budaya. Setiap program
                                dirancang untuk memperkuat kaderisasi da’i, mengembangkan metode dakwah kreatif, serta
                                memberikan kontribusi nyata bagi masyarakat Sulit Air.</p><br>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-12 my-auto">
                    <a href="#">
                        <img class="w-100 border-radius-lg shadow-lg" src="{{ asset('assets_frontend/img/masjidgontor.jpg') }}"
                            alt="Dakwah Image">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="my-5 py-5">
        <div class="container">
            <div class="row justify-content-center text-center ms-auto me-auto">
                <div class="col-lg-10 mb-5">
                    <h2 class="text-dark mb-0">PENGURUS DEWAN DAKWAH RISALAH</h2>
                    <p class="text-muted mt-3 p-horizontal">
                        Sosok yang menjadi panutan dan penggerak utama organisasi. Dengan visi yang jelas dan semangat
                        pengabdian tinggi, beliau memimpin Dewan Da’wah Risalah Islamiyyah untuk mewujudkan tujuan
                        dakwah dan pemberdayaan masyarakat.
                    </p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row align-items-center">
                <!-- Foto / kartu pemimpin -->
                <div class="col-lg-4 ms-auto me-auto p-lg-4 mt-lg-0 mt-4">
                    <div class="rotating-card-container">
                        <div
                            class="card card-rotate card-background card-background-mask-primary shadow-dark mt-md-0 mt-5">
                            <div class="front front-background"
                                style="background-image: url('{{ asset('assets_frontend/img/ketua.jpg') }}'); background-size: cover;">
                                <div class="card-body py-7 text-center"><br><br>
                                    <h3 class="text-white">Ketua Umum</h3>
                                    <p class="text-white opacity-8 ">Pemimpin yang menginspirasi dengan visi, empati,
                                        dan dedikasi untuk kemajuan dakwah di Sulit Air.</p>
                                </div>
                            </div>
                            <div class="back back-background"
                                style="background-image: url('{{ asset('assets_frontend/img/fotoketua.png') }}'); background-size: cover;">
                                <div class="card-body pt-7 text-center">
                                    <h3 class="text-white">Tentang Pemimpin Kami</h3>
                                    <p class="text-white opacity-8" style="text-align: justify;">
                                        Memimpin dengan prinsip kolaborasi, amanah, dan inovasi dalam memperkuat peran
                                        lembaga dakwah di tingkat lokal dan regional.
                                    </p>
                                    <!--Link selengkapnya di hide dahulu-->
                                    <!--<a href="#" class="btn btn-white btn-sm w-50 mx-auto mt-3">Selengkapnya</a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi nilai kepemimpinan -->
                <div class="col-lg-6 ms-auto">
                    <div class="row justify-content-start">
                        <div class="col-md-6">
                            <div class="info">
                                <i class="material-symbols-rounded text-gradient text-success text-3xl">groups</i>
                                <h5 class="font-weight-bolder mt-3">Kaderisasi & Pendidikan</h5>
                                <p class="pe-5" style="text-align: justify;">Membangun kapasitas da’i dan anggota
                                    melalui pendidikan berkelanjutan.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info">
                                <i class="material-symbols-rounded text-gradient text-success text-3xl">verified</i>
                                <h5 class="font-weight-bolder mt-3">Amanah & Integritas</h5>
                                <p class="pe-3" style="text-align: justify;">Menjunjung tinggi kejujuran, tanggung
                                    jawab, dan etika dalam penyelenggaraan dakwah.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-start mt-5">
                        <div class="col-md-6 mt-3">
                            <i class="material-symbols-rounded text-gradient text-success text-3xl">lightbulb</i>
                            <h5 class="font-weight-bolder mt-3">Inovasi Dakwah</h5>
                            <p class="pe-5" style="text-align: justify;">Mengembangkan konsep dan metode dakwah yang
                                relevan dengan tantangan masa kini.</p>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="info">
                                <i class="material-symbols-rounded text-gradient text-success text-3xl">handshake</i>
                                <h5 class="font-weight-bolder mt-3">Kemitraan</h5>
                                <p class="pe-3" style="text-align: justify;">Membangun sinergi dengan lembaga
                                    pemerintah, yayasan, dan komunitas lokal.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- KEMITRAAN ORGANISASI --}}
    
    <section class="py-6">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Kemitraan</h2>
                <div class="col-12 p-0">
                    <img src="{{ asset('assets_frontend/img/kemitraan.png') }}" alt="Dakwah Image" class="img-fluid w-100">
                </div>
            <p class="text-muted mb-5 p-horizontal">Membangun sinergi dengan lembaga pemerintah, yayasan, dan komunitas
                lokal.</p>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <i class="material-symbols-rounded text-gradient text-success text-5xl">account_balance</i>
                    <h6 class="font-weight-bolder mt-3">Lembaga Pemerintah</h6>
                    <p class="small p-horizontal">Nagari, BUMNagari, MUI, dan KAN</p>
                </div>
                <div class="col-md-3 mb-4">
                    <i class="material-symbols-rounded text-gradient text-success text-5xl">diversity_3</i>
                    <h6 class="font-weight-bolder mt-3">Tokoh Masyarakat Atau Publik</h6>
                    <p class="small p-horizontal"></p>
                </div>
                <div class="col-md-3 mb-4">
                    <i class="material-symbols-rounded text-gradient text-success text-5xl">forum</i>
                    <h6 class="font-weight-bolder mt-3">Lembaga Kemasyarakatan</h6>
                    <p class="small p-horizontal">DPP SAS, DPP IPPSA, dan Lembaga Lainnya.</p>
                </div>
                <div class="col-md-3 mb-4">
                    <i class="material-symbols-rounded text-gradient text-success text-5xl">diversity_4</i>
                    <h6 class="font-weight-bolder mt-3">Kelompok Masyarakat Lain</h6>
                    <p class="small p-horizontal">Yayasan Gunung Merah, Yayasan Gunung Putih, dan Pihak - Pihak Lainnya.
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
            const carousel = document.querySelector('#carouselExampleControls');
            const dots = document.querySelectorAll('#hero-dots .dot');

            // Aktifkan carousel otomatis
            const bsCarousel = new bootstrap.Carousel(carousel, {
                interval: 4000,
                ride: 'carousel',
                pause: false, // biar tidak berhenti saat mouse hover
                wrap: true // biar berputar terus
            });

            // Update titik saat slide berubah
            carousel.addEventListener('slide.bs.carousel', function(event) {
                dots.forEach((dot, i) => {
                    dot.style.opacity = i === event.to ? "1" : "0.5";
                });
            });

            // Klik titik untuk pindah slide
            dots.forEach((dot, i) => {
                dot.addEventListener('click', () => bsCarousel.to(i));
            });
        });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
            const el = document.getElementById('state1');
            if (!el) return;

            // Ambil nilai mentah dari attribute data-count / data-raw
            const end = parseInt(el.getAttribute('data-count') || el.getAttribute('data-raw') || '0', 10) || 0;

            // Jika 0, langsung tampilkan Rp 0
            if (end === 0) {
                el.textContent = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    maximumFractionDigits: 0
                }).format(0);
                return;
            }

            // Simple count-up
            const duration = 1000; // durasi animasi (ms)
            const frameRate = 60; // fps
            const totalFrames = Math.round((duration / 1000) * frameRate);
            let frame = 0;
            const easeOutQuad = t => t * (2 - t);

            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0
            });

            const start = 0;
            const animate = () => {
                frame++;
                const progress = easeOutQuad(frame / totalFrames);
                const current = Math.round(start + (end - start) * progress);
                el.textContent = formatter.format(current);

                if (frame < totalFrames) {
                    requestAnimationFrame(animate);
                } else {
                    // pastikan akhir tepat
                    el.textContent = formatter.format(end);
                }
            };

            requestAnimationFrame(animate);
        });
</script>
@endpush