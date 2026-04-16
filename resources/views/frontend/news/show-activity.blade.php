@extends('frontend.layouts.app')

@push('css')
<style>
    .article-header {
        height: 60vh;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .article-header .mask {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
    }

    .article-content img {
        max-width: 100%;
        border-radius: 0.75rem;
        margin: 1.5rem 0;
    }

    .article-content {
        text-align: justify;
        line-height: 1.8;
    }

    .article-meta {
        font-size: 0.9rem;
        color: #6c757d;
    }
</style>
@endpush

@section('content')

<!-- Header Activity -->
<header class="header-2 position-relative overflow-hidden">
    <div class="article-header" style="background-image: url('{{ asset('storage/' . $activity->foto) }}')">
        <span class="mask"></span>
        <div class="container h-100 d-flex align-items-center position-relative">
            <div class="row">
                <div class="col-lg-10 text-white">
                    <h1 class="fw-bold text-white">{{ $activity->nama_kegiatan }}</h1>
                    <p class="article-meta text-white-50 mt-3">
                        <i class="far fa-calendar me-1"></i>
                        @if ($activity->created_at)
                        {{ $activity->created_at->translatedFormat('d F Y') }}
                        @else
                        Tidak ada tanggal
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Konten Ativitys -->
<div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Artikel -->
                <div class="col-lg-8 mx-auto">
                    <div class="article-content">
                        {!! $activity->deskripsi !!}
                    </div>

                    <!-- Tombol Kembali -->
                    <div class="mt-5">
                        <a href="{{ route('activity') }}" class="btn bg-gradient-success text-white">
                            Kembali ke Daftar Kegiatan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection