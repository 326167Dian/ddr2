@extends('frontend.layouts.app')

@push('css')
<style>
    .hero-banner {
        width: 100%;
    }

    .hero-banner img {
        display: block;
        width: 100%;
        height: auto;
    }

    .seminar-shell {
        background: linear-gradient(180deg, #f6fbef 0%, #eef7e7 45%, #e4f1d8 100%);
        border: 1px solid rgba(58, 110, 46, 0.14);
        box-shadow: 0 18px 40px rgba(45, 90, 40, 0.12);
    }

    .seminar-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(74, 122, 57, 0.14);
        box-shadow: 0 16px 30px rgba(41, 90, 40, 0.1);
        background: rgba(255, 255, 255, 0.72);
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
    {{-- Banner dinamis sementara dinonaktifkan. --}}
    <div class="hero-banner">
        <img src="{{ asset('assets_frontend/img/background.jpg') }}" alt="Banner Seminar">
    </div>
</header>

<div class="card card-body blur shadow-blur seminar-shell mx-3 mx-md-4 mt-4 mt-md-5">

    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h2 class="mb-0 fw-bold" style="color: #234f2a;">Seminar & Pelatihan Terkini</h2>
                    <p class="mt-3 p-horizontal" style="color: #46624c;">
                        Tingkatkan kompetensi dan pengetahuan Anda dengan mengikuti seminar, pelatihan, dan workshop
                        terbaru yang kami selenggarakan di berbagai daerah di Indonesia.
                    </p>
                </div>
            </div>
            <div class="row">
                <!-- Contoh 1 -->
                @foreach ($seminars as $seminar)
                @php
                    $seminarBanner = filled($seminar->banner) && file_exists(public_path('storage/' . ltrim($seminar->banner, '/')))
                        ? '/storage/' . ltrim($seminar->banner, '/')
                        : asset('assets_frontend/img/bg-landing.jpg');
                @endphp
                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="card seminar-card border-0 shadow-sm h-100">
                        @if ($seminar->banner)
                        <img src="{{ $seminarBanner }}" class="card-img-top"
                            alt="{{ $seminar->title }}" style="height: 220px; object-fit: cover;">
                        @else
                        <div class="bg-light d-flex justify-content-center align-items-center" style="height: 220px;">
                            <span class="text-muted">Tidak ada banner</span>
                        </div>
                        @endif
                        <div class="card-body">
                            <h5 class="fw-bold text-dark">{{ $seminar->title }}</h5>
                            <p class="mb-3" style="color: #46624c;">
                                Pendaftararan mulai :<br> {{ \Carbon\Carbon::parse($seminar->start_at)->format('d M
                                Y,
                                H:i')
                                }}
                                - {{
                                \Carbon\Carbon::parse($seminar->end_at)->format('d M Y, H:i') }} — {{ $seminar->location
                                }}
                            </p>
                            <p class="text-sm p-horizontal" style="color: #46624c;">
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
                            <a href="{{ route('seminar.show', $seminar->id) }}" class="btn bg-gradient-success btn-sm text-white">
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