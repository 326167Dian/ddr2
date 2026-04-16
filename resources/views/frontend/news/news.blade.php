@extends('frontend.layouts.app')

@push('css')
<style>
    .news-shell {
        background: linear-gradient(180deg, #f6fbef 0%, #eef7e7 45%, #e4f1d8 100%);
        border: 1px solid rgba(58, 110, 46, 0.14);
        box-shadow: 0 18px 40px rgba(45, 90, 40, 0.12);
    }

    .news-card img {
        border-radius: 1rem;
        transition: transform 0.3s ease;
    }

    .news-card:hover img {
        transform: scale(1.05);
    }

    .news-card .card-body {
        text-align: justify;
    }

    .news-card {
        border: 1px solid rgba(74, 122, 57, 0.14);
        box-shadow: 0 16px 30px rgba(41, 90, 40, 0.1);
        background: rgba(255, 255, 255, 0.72);
    }

    .news-header {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
        url('{{ asset(' assets_frontend/img/logo.jpg') }}') center/cover;
        height: 50vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .news-header h1 {
        color: #fff;
        font-weight: 700;
    }

    .news-card img {
        height: 220px;
        /* atur tinggi gambar (bisa disesuaikan misalnya 200–250px) */
        width: 100%;
        object-fit: cover;
        /* biar gambar ter-crop rapi tanpa distorsi */
        border-radius: 0.75rem;
        /* biar sudutnya halus */
        transition: transform 0.3s ease;
    }

    .news-card:hover img {
        transform: scale(1.05);
    }


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
                @php
                    $newsBanner = filled($banner->foto) && file_exists(public_path('storage/' . ltrim($banner->foto, '/')))
                        ? asset('storage/' . $banner->foto)
                        : asset('assets_frontend/img/bg5.jpg');
                @endphp
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="page-header min-vh-75"
                        style="background-image: url('{{ $newsBanner }}');">
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

<!-- Konten Berita -->
<div class="card card-body blur shadow-blur news-shell mx-3 mx-md-4 mt-4 mt-md-5">
    <section class="py-5">
        <div class="container">
            <div class="row mb-5 text-center">
                <div class="col-lg-8 mx-auto">
                    <h2 class="fw-bold mb-3" style="color: #234f2a;">Artikel & Berita Terbaru</h2>
                    <p class="p-horizontal" style="color: #46624c;">Temukan berita, artikel, dan informasi menarik seputar kegiatan
                        dakwah, program pendidikan, serta inisiatif sosial yang dilaksanakan oleh Dewan Da’wah Risalah
                        Islamiyyah di Sulit Air.</p>
                </div>
            </div>
            <div class="row g-4 mb-4">
                @foreach ($articles as $article)
                @php
                    $articleCardImage = filled($article->banner) && file_exists(public_path('storage/' . ltrim($article->banner, '/')))
                        ? asset('storage/' . $article->banner)
                        : asset('assets_frontend/img/bg-landing.jpg');
                @endphp
                <!-- Kartu Berita -->
                <div class="col-lg-4 col-md-6">
                    <div class="card news-card shadow-sm h-100">
                        <a href="{{ route('article.show', $article->slug) }}">
                            <img src="{{ $articleCardImage }}" class="card-img-top"
                                alt="{{ $article->title }}">
                        </a>
                        <div class="card-body">
                            <h5 class="fw-bold">{{ $article->title }}</h5>
                            <p class="small mb-2" style="color: #46624c;"><i class="far fa-calendar me-1"></i>
                                @if ($article->published_at)
                                {{ $article->published_at->translatedFormat('d F Y') }}
                                @else
                                Tidak ada tanggal
                                @endif
                            </p>
                            <p style="color: #46624c;">
                                {{ Str::limit(strip_tags($article->content), 100, '...') }}
                            </p>
                            <a href="{{ route('article.show', $article->slug) }}"
                                class="btn btn-sm bg-gradient-success text-white mt-2">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                @endforeach
                @if ($articles->hasPages())
                <div class="row g-4">
                    <div class="d-flex justify-content-center mt-5">
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-dark">

                                {{-- Previous --}}
                                @if ($articles->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">&lt;</span>
                                </li>
                                @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $articles->previousPageUrl() }}" rel="prev">&lt;</a>
                                </li>
                                @endif

                                {{-- Page Numbers --}}
                                @foreach ($articles->links()->elements[0] as $page => $url)
                                @if ($page == $articles->currentPage())
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
                                @if ($articles->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $articles->nextPageUrl() }}" rel="next">&gt;</a>
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

            </div>
        </div>
    </section>
</div>
@endsection