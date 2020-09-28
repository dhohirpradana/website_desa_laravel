@extends('layouts.app')

@section('title', 'Pengaturan')

@section('content-header')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                            <div class="mb-3">
                                <h2 class="mb-0">PENGATURAN</h2>
                                <p class="mb-0 text-sm">Akun Pengguna {{ config('app.name') }}</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('profil') }}" class="btn btn-success" title="Kembali"><i class="fas fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
@include('layouts.components.alert')
<div class="row">
    <div class="col">
        <div class="card bg-secondary shadow h-100">
            <div class="card-header bg-white border-0">
                <h3 class="mb-0">Pengaturan</h3>
            </div>
            <div class="card-body">
                <form autocomplete="off" action="{{ route('update-pengaturan', Auth::user()) }}" method="post">
                    @csrf @method('patch')
                    <h6 class="heading-small text-muted mb-4">Ubah Alamat Email</h6>
                    <div class="pl-lg-4">
                        <p class="mb-3">Biarkan kosong jika tidak ingin mengubah email.</p>
                        <div class="form-group">
                            <label class="form-control-label" for="email_lama">Email Lama</label>
                            <input readonly class="form-control form-control-alternative @error('nama') is-invalid @enderror" type="email" placeholder="Email saat ini" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="email_baru">Email Baru</label>
                            <input class="form-control form-control-alternative @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="Masukkan alamat email baru ..." value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <h6 class="heading-small text-muted mb-4">Ubah Password</h6>
                    <div class="pl-lg-4">
                        <p class="mb-3">Biarkan kosong jika tidak ingin mengubah Password.</p>
                        <div class="form-group">
                            <label class="form-control-label" for="password">Password Baru</label>
                            <input class="form-control form-control-alternative @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="Masukkan password baru" value="{{ old('password') }}">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="password_confirmation">Konfirmasi Password Baru</label>
                            <input class="form-control form-control-alternative @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" id="password_confirmation" placeholder="Masukkan password baru" value="{{ old('password_confirmation') }}">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mt-5">
                        <label class="form-control-label" for="password_lama">Password <span class="text-danger">*</span></label>
                        <input required class="form-control form-control-alternative @error('password_lama') is-invalid @enderror" type="password" name="password_lama" id="password_lama" placeholder="Masukkan password">
                        @error('password_lama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">PERBARUI</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $(document).on("submit","form", function () {
            $(this).children("button:submit").attr('disabled','disabled');
            $(this).children("button:submit").html(`<img height="20px" src="{{ url('/storage/loading.gif') }}" alt=""> Loading ...`);
        });
    });
</script>
@endpush
