@extends('frontend.layouts.app')

@push('css')
<style>
    .structure-shell {
        background: linear-gradient(180deg, #f6fbef 0%, #eef7e7 45%, #e4f1d8 100%);
        border: 1px solid rgba(58, 110, 46, 0.14);
        box-shadow: 0 18px 40px rgba(45, 90, 40, 0.12);
    }

    .org-card {
        border-radius: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(74, 122, 57, 0.14);
        box-shadow: 0 16px 30px rgba(41, 90, 40, 0.1);
    }

    .org-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 36px rgba(41, 90, 40, 0.14);
    }

    .org-title {
        font-weight: 700;
        font-size: 1.25rem;
    }

    .org-position {
        font-size: 0.95rem;
        color: #46624c;
    }

    .org-structure-line {
        width: 2px;
        background-color: #198754;
        height: 40px;
        margin: 0 auto;
    }

    @media (max-width: 767.98px) {
        .org-title {
            font-size: 1.1rem;
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
                @php
                    $structureBanner = filled($banner->foto) && file_exists(public_path('storage/' . ltrim($banner->foto, '/')))
                        ? asset('storage/' . $banner->foto)
                        : asset('assets_frontend/img/bg5.jpg');
                @endphp
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="page-header min-vh-75"
                        style="background-image: url('{{ $structureBanner }}');">
                        <span class="mask bg-gradient-dark"></span>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 my-auto">
                                    <h1 class="text-white fadeIn2 fadeInBottom">{{ $banner->judul }}</h1>
                                    <p class="lead text-white opacity-8 fadeIn3 fadeInBottom">
                                        {{ $banner->deskripsi }}
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

<div class="card card-body blur shadow-blur structure-shell mx-3 mx-md-4 mt-4 mt-md-5">
    {{-- STRUKTUR ORGANISASI --}}
    <section class="py-5 my-4">
        <div class="container text-center">
            <h2 class="mb-5 fw-bold" style="color: #234f2a;">Struktur Organisasi Dewan Da’wah Risalah Islamiyyah</h2>
            <p class="p-horizontal" style="color: #46624c;">
                Struktur ini menggambarkan komitmen Dewan Da’wah Risalah Islamiyyah untuk bekerja secara kolektif dan
                transparan dalam menyelenggarakan dakwah, pendidikan, dan program sosial demi kemaslahatan umat.
            </p><br>

            {{-- Ketua Umum --}}
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card org-card text-white p-4" style="background: linear-gradient(135deg, #275626 0%, #3b7b3e 100%);">
                        <h5 class="org-title text-white">MUSYAWARAH TAHUNAN</h5>
                    </div>
                </div>
            </div>

            <div class="org-structure-line my-4"></div>

            {{-- Sekretaris & Bendahara --}}
            <div class="row justify-content-center">
                <div class="col-md-4 mb-4">
                    <div class="card org-card text-white p-4" style="background: linear-gradient(135deg, #275626 0%, #3b7b3e 100%);">
                        <i class="material-symbols-rounded text-success text-3xl mb-3">person</i>
                        <h6 class="org-title text-white">Prof. Jurnalis Uddin</h6>
                        <p class="org-position text-white">Dewan Pembina</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card org-card text-white p-4" style="background: linear-gradient(135deg, #275626 0%, #3b7b3e 100%);">
                        <i class="material-symbols-rounded text-success text-3xl mb-3">crown</i>
                        <h6 class="org-title text-white">Dr. M. Akhyar Adnan, MA</h6>
                        <p class="org-position text-white">Ketua Umum</p>
                    </div>
                </div>
            </div>

            <div class="org-structure-line my-4"></div>

            {{-- Bidang-Bidang --}}
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card org-card p-4 h-100" style="background: rgba(255, 255, 255, 0.68);">
                        <i class="material-symbols-rounded text-success text-3xl mb-3">person</i>
                        <h6 class="org-title">Prof. Dr. M. Amin Nurdin, MA</h6>
                        <p class="org-position">Dewan Pakar</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card org-card text-white p-4 h-100" style="background: linear-gradient(135deg, #275626 0%, #3b7b3e 100%);">
                        <i class="material-symbols-rounded text-success text-3xl mb-3">person</i>
                        <h6 class="org-title text-white">H. Fauzul Abrar, S.H. </h6>
                        <p class="org-position text-white">Sekretaris Umum</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card org-card p-4 h-100" style="background: rgba(255, 255, 255, 0.68);">
                        <i class="material-symbols-rounded text-success text-3xl mb-3">person</i>
                        <h6 class="org-title">RW . DT. Rajo Lenggang</h6>
                        <p class="org-position">Bendahara Umum</p>
                    </div>
                </div>
            </div>

            <div class="org-structure-line my-4"></div>

            {{-- Bidang-Bidang --}}
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card org-card p-4 h-100" style="background: rgba(255, 255, 255, 0.68);">
                        <i class="material-symbols-rounded text-success text-3xl mb-3">campaign</i>
                        <h6 class="org-title">Bidang Dakwah / Tabligh</h6>
                        <p class="org-position">Ketua: Syamsuardi Rusli, MA  <br>
                        Wk. Ketua : Ust. Hidayatullah
                        Anggota : H. Hery Gani</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card org-card p-4 h-100" style="background: rgba(255, 255, 255, 0.68);">
                        <i class="material-symbols-rounded text-success text-3xl mb-3">handshake</i>
                        <h6 class="org-title">Bidang Ekonomi & Pembangunan SDM</h6>
                        <p class="org-position">Ketua: Ir. Edwaren Liun <br>
                        Anggota : Ir. H. Andrizal,<br>Hj. Nita Zainal, SE <br>
                            Edwin Nazar <br>
                            Ipsen Hardi 
                            </p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card org-card p-4 h-100" style="background: rgba(255, 255, 255, 0.68);">
                        <i class="material-symbols-rounded text-success text-3xl mb-3">diversity_3</i>
                        <h6 class="org-title">Bidang Sosial & Budaya</h6>
                        <p class="org-position">Ketua: Dr. Dra. Hj. Rosi Yulita Rusli, MA  <br> 
                            Anggota : Refian Erlinda,<br>
                            Ir. H. Respalito Alwie,<br>  
                            R. Putrawan,<br>
                            Jhonaedi Villy,<br>
                            Azwardi Azwir
                            
                            </p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card org-card p-4 h-100" style="background: rgba(255, 255, 255, 0.68);">
                        <i class="material-symbols-rounded text-success text-3xl mb-3">school</i>
                        <h6 class="org-title">Bidang Pendidikan</h6>
                        <p class="org-position">Ketua: Drs. Azzam Manan, MA<br> Anggota : 
                            Jaka Setiawan, MSi<br>
                            Dr. Nablur Rahman Nibras, Lc, MA<br>
                            H. Arief Adi Wibawa, SE, MM
                            </p>
                    </div>
                </div>
            </div>

            <div class="org-structure-line my-4"></div>

            {{-- Anggota --}}
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card org-card text-white p-4 h-100" style="background: linear-gradient(135deg, #275626 0%, #3b7b3e 100%);">
                        <i class="material-symbols-rounded text-success text-3xl mb-3">groups</i>
                        <h6 class="org-title text-white">Relawan & Anggota</h6>
                        <p class="org-position text-white">Terdiri dari mubaligh, ustadz/ustadzah, dan relawan komunitas
                            yang aktif
                            di lapangan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection