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
<!-- Header -->
<header class="header-2 position-relative overflow-hidden">
    <div id="hero-slider" class="position-relative" style="height: 75vh; overflow: hidden;">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner mb-4">
                @foreach ($banners as $banner)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="page-header min-vh-75"
                        style="background-image: url('{{ asset('storage/' . $banner->foto) }}');">
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

<div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
    <section class="my-4 py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="row justify-content-center text-center ms-auto me-auto">
                    <div class="col-lg-10">
                        <h2 class="text-dark mb-0">Kegiatan Kami</h2>
                        <p class="text-muted mt-3 p-horizontal">Dewan Da’wah Risalah Islamiyyah aktif menyelenggarakan
                            berbagai program dakwah, pendidikan, pelatihan kader, dan aksi sosial untuk meningkatkan
                            kesejahteraan masyarakat Sulit Air.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row align-items-center mt-3">
                @foreach ($activities as $activity)
                <div class="col-lg-4 ms-auto me-auto p-lg-4 mt-lg-0 mt-4">
                    <div class="rotating-card-container">
                        <div
                            class="card card-rotate card-background card-background-mask-primary shadow-dark mt-md-0 mt-5">
                            <div class="front front-background" style=" 
                                background-image: url('{{ asset('assets_frontend/img/logo.jpg') }}'); 
                                background-repeat: no-repeat; 
                                background-position: center; 
                                background-size: contain; 
                                height: 440px; 
                                border-radius: 1rem;">
                                <div class="card-body py-7 text-center">
                                    <i class="material-symbols-rounded text-white text-4xl my-3">touch_app</i>
                                    <h3 class="text-white">Bidang {{ $activity->bidang->name }}</h3>
                                    <p class="text-white opacity-8">{{ $activity->nama_kegiatan }}</p>
                                </div>
                            </div>
                            <div class="back back-background" style="
                                background-image: url('{{ asset('storage/' . $activity->foto) }}');
                                background-repeat: no-repeat; 
                                background-position: center; 
                                background-size: cover; 
                                height: 440px; 
                                border-radius: 1rem;">
                                <div class="card-body pt-7 text-center">
                                    <h3 class="text-white">{{ $activity->nama_kegiatan }}</h3>
                                    <p class="text-white opacity-8">{{ $activity->tanggal_mulai->translatedFormat('d F
                                        Y') }}</p>
                                    <a href="{{ route('activity.show', $activity->slug) }}"
                                        class="btn btn-white btn-sm w-50 mx-auto mt-3">Lihat
                                        Program</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Pagination -->
        @if ($activities->hasPages())
        <div class="row g-4">
            <div class="d-flex justify-content-center mt-5">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-dark">

                        {{-- Previous --}}
                        @if ($activities->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">&lt;</span>
                        </li>
                        @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $articles->previousPageUrl() }}" rel="prev">&lt;</a>
                        </li>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach ($activities->links()->elements[0] as $page => $url)
                        @if ($page == $activities->currentPage())
                        <li class="page-item active">
                            <span class="page-link text-white">{{ $page }}</span>
                        </li>
                        @else
                        <li class="page-item">
                            <a class="page-link text-dark" href="{{ $url }}">{{ $page }}</a>
                        </li>
                        @endif
                        @endforeach

                        {{-- Next --}}
                        @if ($activities->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $activities->nextPageUrl() }}" rel="next">&gt;</a>
                        </li>
                        @else
                        <li class="page-item disabled">
                            <span class="page-link">&gt;</span>
                        </li>
                        @endif

                    </ul>
                </nav>
            </div>
        </div>
        @endif


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
@endpush