@extends('frontend.layouts.app')

@push('css')
<style>
    .seminar-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .seminar-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

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

    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h2 class="text-dark mb-0 fw-bold">Seminar & Pelatihan Terkini</h2>
                    <p class="text-muted mt-3 p-horizontal">
                        Tingkatkan kompetensi dan pengetahuan Anda dengan mengikuti seminar, pelatihan, dan workshop
                        terbaru yang kami selenggarakan di berbagai daerah di Indonesia.
                    </p>
                </div>
            </div>
            <div class="row">
                <!-- Contoh 1 -->
                @foreach ($seminars as $seminar)
                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="card seminar-card border-0 shadow-sm h-100">
                        @if ($seminar->banner)
                        <img src="{{ asset('storage/' . $seminar->banner) }}" class="card-img-top"
                            alt="{{ $seminar->title }}" style="height: 220px; object-fit: cover;">
                        @else
                        <div class="bg-light d-flex justify-content-center align-items-center" style="height: 220px;">
                            <span class="text-muted">Tidak ada banner</span>
                        </div>
                        @endif
                        <div class="card-body">
                            <h5 class="fw-bold text-dark">{{ $seminar->title }}</h5>
                            <p class="text-muted mb-3">
                                Pendaftararan mulai :<br> {{ \Carbon\Carbon::parse($seminar->start_at)->format('d M
                                Y,
                                H:i')
                                }}
                                - {{
                                \Carbon\Carbon::parse($seminar->end_at)->format('d M Y, H:i') }} — {{ $seminar->location
                                }}
                            </p>
                            <p class="text-sm p-horizontal">
                                {!! Str::limit($seminar->description, 90) !!}
                            </p>
                        </div>
                        @if ($seminar->registrations->isNotEmpty() && $seminar->registrations->first()->status ==
                        'approved')
                        <div class="card-footer bg-transparent border-0 text-center">
                            <a href="{{ route('seminar.show', $seminar->id) }}" class="btn bg-gradient-success btn-sm">
                                Anda sudah terdaftar
                            </a>
                        </div>
                        @else
                        <div class="card-footer bg-transparent border-0 text-center">
                            <a href="{{ route('seminar.show', $seminar->id) }}" class="btn bg-gradient-info btn-sm">
                                Daftar Seminar
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-dark">
                        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">
                                < </a>
                        </li>
                        <li class="page-item active"><a class="page-link text-white" href="#">1</a></li>
                        <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>
                        <li class="page-item"><a class="page-link text-dark" href="#">3</a></li>
                        <li class="page-item"><a class="page-link text-dark" href="#">></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>

    {{-- <section class="py-6 bg-gradient-light">
        <div class="container text-center">
            <h3 class="text-dark mb-4 fw-bold">Ingin Menyelenggarakan Seminar Bersama Kami?</h3>
            <p class="text-muted mb-4">
                Hubungi tim kami untuk kolaborasi penyelenggaraan seminar atau pelatihan profesi apoteker di daerah
                Anda.
            </p>
            <a href="#" class="btn bg-gradient-info">Hubungi Kami</a>
        </div>
    </section> --}}

</div>
@endsection