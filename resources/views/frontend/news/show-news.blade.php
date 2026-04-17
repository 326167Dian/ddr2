@extends('frontend.layouts.app')

@push('css')
<style>
    .article-shell {
        background: linear-gradient(180deg, #f6fbef 0%, #eef7e7 45%, #e4f1d8 100%);
        border: 1px solid rgba(58, 110, 46, 0.14);
        box-shadow: 0 18px 40px rgba(45, 90, 40, 0.12);
    }

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

    .article-shell .article-content,
    .article-shell .article-content p,
    .article-shell .article-content li {
        color: #46624c;
    }
</style>
@endpush

@section('content')
@php
    $articleBanner = filled($article->banner) && file_exists(public_path('storage/' . ltrim($article->banner, '/')))
    ? '/storage/' . ltrim($article->banner, '/')
        : asset('assets_frontend/img/bg5.jpg');
@endphp

<!-- Header Artikel -->
<header class="header-2 position-relative overflow-hidden">
    <div class="article-header" style="background-image: url('{{ $articleBanner }}')">
        <span class="mask"></span>
        <div class="container h-100 d-flex align-items-center position-relative">
            <div class="row">
                <div class="col-lg-10 text-white">
                    <h1 class="fw-bold text-white">{{ $article->title }}</h1>
                    <p class="article-meta text-white-50 mt-3">
                        <i class="far fa-calendar me-1"></i>
                        @if ($article->published_at)
                        {{ $article->published_at->translatedFormat('d F Y') }}
                        @else
                        Tidak ada tanggal
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Konten Artikel -->
<div class="card card-body blur shadow-blur article-shell mx-3 mx-md-4 mt-4 mt-md-5">
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Artikel -->
                <div class="col-lg-8 mx-auto">
                    <div class="article-content">
                        {!! $article->content !!}
                    </div>

                    <!-- Tombol Kembali -->
                    <div class="mt-5">
                        <a href="{{ route('article') }}" class="btn bg-gradient-success text-white">
                            Kembali ke Daftar Artikel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection