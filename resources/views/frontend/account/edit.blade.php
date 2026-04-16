@extends('frontend.layouts.app')

@push('css')
<style>
    .profile-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .profile-img {
        width: 100%;
        max-width: 250px;
        border-radius: 50%;
        object-fit: cover;
    }

    .form-label {
        font-weight: 600;
    }

    @media (max-width: 767.98px) {
        .profile-img {
            margin-bottom: 20px;
            max-width: 180px;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-7 mt-8">
    <div class="card profile-card border-0 shadow-sm p-4 rounded">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row align-items-start">
                <!-- Foto profil kiri -->
                <div class="col-md-4 text-center mb-4 mb-md-0">
                    <img src="{{ $profile->foto 
                            ? asset('storage/' . $profile->foto) 
                            : asset('assets_frontend/img/bruce-mars.jpg') }}" class="profile-img shadow-sm mb-3"
                        alt="Profile">

                    <div class="input-group input-group-outline my-3">
                        <input type="file" name="foto" class="form-control form-control-sm">
                    </div>
                    <small class="text-muted">Kosongkan jika tidak diganti</small>
                </div>

                <!-- Form kanan -->
                <div class="col-md-8">
                    <h3 class="fw-bold mb-4 text-center text-md-start">
                        Edit Profile
                    </h3>

                    <div class="input-group input-group-outline my-3 is-focused is-filled">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $profile->name) }}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="input-group input-group-outline my-3 is-filled">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $profile->email) }}">
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div
                        class="input-group input-group-outline my-3 {{ old('no_tlp', $profile->no_tlp) ? 'is-filled' : '' }}">
                        <label class="form-label">No. WhatsApp</label>
                        <input type="text" name="no_tlp" class="form-control"
                            value="{{ old('no_tlp', $profile->no_tlp) }}">
                        @error('no_tlp')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div
                        class="input-group input-group-outline my-3 {{ old('alamat', $profile->alamat) ? 'is-filled' : '' }}">
                        <label class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control"
                            value="{{ old('alamat', $profile->alamat) }}">
                        @error('alamat')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div
                        class="input-group input-group-outline my-3 {{ old('profesi', $profile->profesi) ? 'is-filled' : '' }}">
                        <label class="form-label">Profesi</label>
                        <input type="text" name="profesi" class="form-control"
                            value="{{ old('profesi', $profile->profesi) }}">
                        @error('profesi')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Pilih Suku</label>
                        <select class="form-control" name="suku" id="exampleFormControlSelect1">
                            <option value="">Pilih Suku</option>
                            <option value="Limo Panjang" {{ old('suku', $profile->suku) == 'Limo Panjang' ? 'selected' :
                                '' }}>
                                Limo Panjang
                            </option>
                            <option value="lorem" {{ old('suku', $profile->suku) == 'lorem' ? 'selected' : '' }}>
                                lorem
                            </option>
                            <option value="lorem 2" {{ old('suku', $profile->suku) == 'lorem 2' ? 'selected' : '' }}>
                                lorem 2
                            </option>
                            <option value="lorem 3" {{ old('suku', $profile->suku) == 'lorem 3' ? 'selected' : '' }}>
                                lorem 3
                            </option>
                        </select>
                        @error('suku')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="input-group input-group-outline my-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengubah password
                    </small>

                    <!-- Tombol -->
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-success">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('profile') }}" class="btn btn-secondary">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection