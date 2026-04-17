@extends('frontend.layouts.app')

@push('css')
<style>
    .seminar-detail-shell {
        background: linear-gradient(180deg, #f6fbef 0%, #eef7e7 45%, #e4f1d8 100%);
        border: 1px solid rgba(58, 110, 46, 0.14);
        box-shadow: 0 18px 40px rgba(45, 90, 40, 0.12);
    }

    .seminar-detail-shell .card {
        border: 1px solid rgba(74, 122, 57, 0.14);
        box-shadow: 0 18px 36px rgba(41, 90, 40, 0.12);
        background: rgba(255, 255, 255, 0.78);
    }

    .seminar-detail-shell p,
    .seminar-detail-shell li {
        color: #46624c;
    }
</style>
@endpush

@section('content')
@php
    $seminarBanner = filled($seminar->banner) && file_exists(public_path('storage/' . ltrim($seminar->banner, '/')))
    ? '/storage/' . ltrim($seminar->banner, '/')
        : asset('assets_frontend/img/bg-landing.jpg');
@endphp
<section class="py-6 seminar-detail-shell">
    <div class="container py-5">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

                {{-- Banner Seminar --}}
                @if ($seminar->banner)
                <img src="{{ $seminarBanner }}" alt="{{ $seminar->title }}" class="card-img-top"
                    style="max-height: 350px; object-fit: cover;">
                @endif

                <div class="card-body p-4">
                    <h2 class="fw-bold text-dark mb-3">{{ $seminar->title }}</h2>

                    <p class="text-muted mb-3">
                        Pendaftaran dimulai dari <strong>{{ \Carbon\Carbon::parse($seminar->start_at)->format('d M Y,
                            H:i') }}
                            - {{ \Carbon\Carbon::parse($seminar->end_at)->format('d M Y, H:i') }} — {{
                            $seminar->location
                            }}</strong>
                    </p>

                    <p class="text-secondary fs-6" style="white-space: pre-line;">
                        {!! $seminar->description !!}
                    </p>

                    {{-- Biaya --}}
                    @if ($seminar->price)
                    <div class="p-3 mb-3 rounded-3 bg-gray-200 bg-opacity-10">
                        <p class="mb-0 fw-bold text-dark fs-6">
                            Biaya Pendaftaran: Rp {{ number_format($seminar->price, 0, ',', '.') }}
                        </p>
                    </div>
                    @endif

                    @php
                    $registrationsCount = $seminar->registrations->count();
                    $slotsLeft = $seminar->quota - $registrationsCount;
                    $isFull = $slotsLeft <= 0; @endphp {{-- Notifikasi sukses --}} @if (session('success')) <div
                        class="alert alert-success alert-dismissible fade show" role="alert">
                        ✅ {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                {{-- Status Kuota --}}
                @if ($isFull)
                <div class="alert alert-danger text-center">
                    Kuota seminar sudah penuh.
                </div>
                @else
                <p class="text-muted mb-3">
                    Sisa kuota: <strong>{{ $slotsLeft }}</strong> peserta
                </p>
                @endif

                <hr>

                {{-- Autentikasi --}}
                @auth
                @php
                $registration = $seminar->registrations->where('user_id', auth()->id())->first();
                @endphp

                {{-- Jika sudah daftar --}}
                @if ($registration)
                {{-- Sudah approved --}}
                @if ($registration->status == 'approved')
                <div class="alert alert-success d-flex align-items-center">
                    ✅ <span class="ms-2">Kamu sudah terdaftar pada seminar ini!</span>
                </div>

                {{-- Link tambahan --}}
                @if ($seminar->link)
                <p><strong>🎯 Link seminar:</strong>
                    <a href="{{ $seminar->link }}" target="_blank"
                        class="text-decoration-none text-success fw-semibold">
                        {{ $seminar->link }}
                    </a>
                </p>
                @endif
                @if ($seminar->link_whatsapp)
                <p><strong>💬 Link WhatsApp Group:</strong>
                    <a href="{{ $seminar->link_whatsapp }}" target="_blank"
                        class="text-decoration-none text-success fw-semibold">
                        {{ $seminar->link_whatsapp }}
                    </a>
                </p>
                @endif
                @if ($seminar->link_video)
                <p><strong>🎥 Rekaman Webinar:</strong>
                    <a href="{{ $seminar->link_video }}" target="_blank"
                        class="text-decoration-none text-success fw-semibold">
                        {{ $seminar->link_video }}
                    </a>
                </p>
                @endif
                @if ($seminar->link_document)
                <p><strong>📄 Dokumen:</strong>
                    <a href="{{ $seminar->link_document }}" target="_blank"
                        class="text-decoration-none text-success fw-semibold">
                        {{ $seminar->link_document }}
                    </a>
                </p>
                @endif
                <a href="{{ route('seminar') }}" class="btn btn-outline-secondary btn-lg px-4">
                    Kembali ke Daftar Seminar
                </a>
                @else
                {{-- Sudah daftar tapi belum bayar --}}
                <div class="alert alert-warning">
                    ⚠️ Kamu sudah terdaftar, tetapi belum menyelesaikan pembayaran.
                </div>

                <div class="card bg-light border-0 mb-3">
                    <div class="card-body">
                        <h6 class="fw-bold text-success mb-2">💳 Pilihan Pembayaran:</h6>
                        {{-- <p class="text-muted mb-2">Silakan pilih metode pembayaran:</p>

                        <button id="pay-button" class="btn btn-success w-100 mb-2">
                            💳 Bayar Otomatis via Midtrans
                        </button> --}}

                        <div class="border-top pt-3">
                            <p class="fw-bold text-secondary mb-1">💸 Transfer Manual:</p>
                            <ul class="list-unstyled mb-0">
                                <li><strong>Bank:</strong> BCA</li>
                                <li><strong>Nama:</strong> eneng siti wulandari</li>
                                <li><strong>No. Rekening:</strong> 1391928130</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <a href="https://wa.me/{{ $seminar->whatsapp_admin }}" target="_blank"
                    class="btn btn-outline-success w-100">
                    💬 Konfirmasi Pembayaran via WhatsApp
                </a>
                @endif
                @else
                {{-- Belum daftar --}}
                @if (!$isFull)
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <form action="{{ route('seminar.register', $seminar->id) }}" method="POST" class="m-0">
                        @csrf
                        <button class="btn btn-success btn-lg px-4">
                            Daftar Sekarang
                        </button>
                    </form>

                    <a href="{{ route('seminar') }}" class="btn btn-outline-secondary btn-lg px-4">
                        Kembali ke Daftar Seminar
                    </a>
                </div>
                @endif
                @endif
                @else
                {{-- Jika belum login --}}
                @if (!$isFull)
                <div class="alert alert-info text-center">
                    🔒 Silakan login terlebih dahulu untuk mendaftar Seminar ini.
                </div>

                <div class="d-flex flex-wrap gap-3 mt-4">
                    <button class="btn btn-success btn-lg px-4" onclick="window.location.href='{{ route('login') }}'">
                        Login untuk Daftar
                    </button>

                    <a href="{{ route('seminar') }}" class="btn btn-outline-secondary btn-lg px-4">
                        Kembali ke Daftar Seminar
                    </a>
                </div>
                @endif
                @endauth

            </div>
        </div>
    </div>
    </div>
</section>

{{-- Midtrans Payment Script --}}
{{-- @if(isset($snapToken))
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
    const payButton = document.getElementById('pay-button');
    if (payButton) {
        payButton.addEventListener('click', function() {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert("Pembayaran berhasil!");
                    window.location.href = "{{ route('events.show', $event->id) }}";
                },
                onPending: function(result) {
                    alert("Menunggu pembayaran...");
                },
                onError: function(result) {
                    alert("Pembayaran gagal!");
                },
                onClose: function() {
                    alert('Kamu menutup popup tanpa menyelesaikan pembayaran');
                }
            });
        });
    }
</script>
@endif --}}

{{-- Efek Hover --}}
<style>
    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection