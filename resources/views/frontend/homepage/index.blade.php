@extends('frontend.layouts.app')
@push('css')
<style>
    .navbar .btn.bg-gradient-success,
    .homepage-shell .btn.bg-gradient-success,
    .homepage-shell .btn-success {
        background: linear-gradient(135deg, #2d7a3d 0%, #4ca95b 100%);
        border: none;
        box-shadow: 0 12px 24px rgba(45, 122, 61, 0.24);
    }

    .navbar .btn.bg-gradient-success:hover,
    .homepage-shell .btn.bg-gradient-success:hover,
    .homepage-shell .btn-success:hover {
        background: linear-gradient(135deg, #256633 0%, #3f944e 100%);
        box-shadow: 0 14px 28px rgba(37, 102, 51, 0.28);
    }

    .homepage-shell {
        background: linear-gradient(180deg, #f6fbef 0%, #eef7e7 45%, #e5f2dc 100%);
        border: 1px solid rgba(58, 110, 46, 0.14);
        box-shadow: 0 18px 40px rgba(45, 90, 40, 0.12);
    }

    .hero-banner {
        width: 100%;
    }

    .hero-banner img {
        display: block;
        width: 100%;
        height: auto;
    }

    .stats-panel,
    .info-panel,
    .leadership-panel,
    .partnership-panel,
    .value-card {
        border-radius: 24px;
    }

    .stats-panel {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.88), rgba(223, 242, 210, 0.88));
        border: 1px solid rgba(83, 131, 65, 0.14);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.5);
    }

    .info-panel,
    .partnership-panel,
    .value-card {
        background: rgba(255, 255, 255, 0.58);
        border: 1px solid rgba(83, 131, 65, 0.14);
        box-shadow: 0 10px 24px rgba(55, 100, 46, 0.08);
    }

    .homepage-shell .card,
    .homepage-shell .info-panel,
    .homepage-shell .value-card,
    .homepage-shell .content-illustration,
    .homepage-shell .partnership-panel {
        border: 1px solid rgba(74, 122, 57, 0.16);
        box-shadow: 0 18px 36px rgba(41, 90, 40, 0.12);
    }

    .leadership-panel {
        background: linear-gradient(180deg, rgba(248, 252, 242, 0.94), rgba(228, 243, 217, 0.92));
        border: 1px solid rgba(83, 131, 65, 0.14);
    }

    .section-title-green {
        color: #1f5c31;
    }

    .section-text-green,
    .homepage-shell p,
    .homepage-shell .small,
    .homepage-shell .text-sm {
        color: #46624c;
    }

    .homepage-shell h2,
    .homepage-shell h5,
    .homepage-shell h6 {
        color: #234f2a;
    }

    .homepage-shell .material-symbols-rounded.text-success,
    .homepage-shell .material-symbols-rounded.text-gradient.text-success {
        color: #2e7d32 !important;
        text-shadow: 0 8px 18px rgba(46, 125, 50, 0.18);
    }

    .homepage-shell .vertical.dark {
        background-image: linear-gradient(180deg, rgba(80, 125, 63, 0), rgba(80, 125, 63, 0.7), rgba(80, 125, 63, 0));
        opacity: 1;
    }

    .content-illustration {
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid rgba(83, 131, 65, 0.16);
        box-shadow: 0 16px 32px rgba(55, 100, 46, 0.14);
        background: rgba(255, 255, 255, 0.72);
    }

    .content-illustration img {
        display: block;
        width: 100%;
        height: 100%;
        min-height: 280px;
        object-fit: cover;
    }

    .partnership-image {
        border-radius: 20px;
        box-shadow: 0 12px 24px rgba(55, 100, 46, 0.12);
    }

    @media (max-width: 767.98px) {
        .homepage-shell {
            border-radius: 24px;
        }

        .content-illustration img {
            min-height: 220px;
        }

        .p-horizontal {
            text-align: justify;
        }
    }
</style>
@endpush
@section('content')
<header class="header-2 position-relative overflow-hidden">
    <div class="hero-banner">
        <img src="{{ asset('assets_frontend/img/lebaran.png') }}" alt="Banner Lebaran Dewan Dakwah Risalah">
    </div>
</header>


<div class="card card-body blur shadow-blur homepage-shell mx-3 mx-md-4 mt-4 mt-md-5">

    <section class="pt-3 pb-4" id="count-stats">
        <div class="container">
            <div class="row stats-panel py-4">
                <div class="col-lg-9 mx-auto py-3">
                    <div class="row">
                        <div class="col-md-6 position-relative">
                            <div class="p-3 text-center">
                                {{--
                                <h1 class="text-gradient text-dark">
                                    <span id="state1" data-count="{{ $articlesCount }}" data-raw="{{ $articlesCount }}">
                                        {{ $articlesCount }}
                                    </span>
                                </h1>
                                --}}
                                <h5 class="mt-3">Artikel / Publikasi</h5>
                                <p class="text-sm font-weight-normal">
                                    Terdapat publikasi dan materi dakwah yang membahas berbagai topik keagamaan dan
                                    sosial.
                                </p>
                            </div>
                            <hr class="vertical dark">
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 text-center">
                                {{--
                                <h1 class="text-gradient text-dark" id="state2" data-count="{{ $activitiesCount }}"
                                    data-raw="{{ $activitiesCount }}">{{ $activitiesCount }}</h1>
                                --}}
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
                    <div class="info-horizontal info-panel border-radius-xl d-block d-md-flex p-4 h-100">
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
                    <div class="content-illustration">
                        <img src="{{ asset('assets_frontend/img/masjidsulitair.jpg') }}" alt="Masjid Sulit Air">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="my-5 py-5 leadership-panel">
        <div class="container">
            <div class="row justify-content-center text-center ms-auto me-auto">
                <div class="col-lg-10 mb-5">
                    <h2 class="section-title-green mb-0">PENGURUS DEWAN DAKWAH RISALAH</h2>
                    <p class="section-text-green mt-3 p-horizontal">
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
                                style="background-image: url('{{ asset('assets_frontend/img/ketua.jpg') }}'); background-size: cover;">
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
                            <div class="info value-card p-4 h-100">
                                <i class="material-symbols-rounded text-gradient text-success text-3xl">groups</i>
                                <h5 class="font-weight-bolder mt-3">Kaderisasi & Pendidikan</h5>
                                <p class="pe-5" style="text-align: justify;">Membangun kapasitas da’i dan anggota
                                    melalui pendidikan berkelanjutan.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info value-card p-4 h-100">
                                <i class="material-symbols-rounded text-gradient text-success text-3xl">verified</i>
                                <h5 class="font-weight-bolder mt-3">Amanah & Integritas</h5>
                                <p class="pe-3" style="text-align: justify;">Menjunjung tinggi kejujuran, tanggung
                                    jawab, dan etika dalam penyelenggaraan dakwah.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-start mt-5">
                        <div class="col-md-6 mt-3">
                            <div class="info value-card p-4 h-100">
                                <i class="material-symbols-rounded text-gradient text-success text-3xl">lightbulb</i>
                                <h5 class="font-weight-bolder mt-3">Inovasi Dakwah</h5>
                                <p class="pe-5" style="text-align: justify;">Mengembangkan konsep dan metode dakwah yang
                                    relevan dengan tantangan masa kini.</p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="info value-card p-4 h-100">
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
    
    <section class="py-6 partnership-panel">
        <div class="container text-center">
            <h2 class="fw-bold mb-4 section-title-green">Kemitraan</h2>
                <div class="col-12 p-0">
                    <img src="{{ asset('assets_frontend/img/kemitraan.png') }}" alt="Kemitraan Dewan Dakwah Risalah" class="img-fluid w-100 partnership-image">
                </div>
            <p class="section-text-green mb-5 p-horizontal">Membangun sinergi dengan lembaga pemerintah, yayasan, dan komunitas
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
{{--
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
--}}