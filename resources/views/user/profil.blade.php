@extends('layouts.app')

@section('title')
Profil Pengguna
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
@endsection

@section('content-header')

<div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="background-image: url({{ asset('/img/cover-bg-profil.jpg') }}); background-size: cover; background-position: center top;">

    <!-- Mask -->
    <span class="mask bg-gradient-primary opacity-6"></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">

        <div class="row">
            <div class="col-lg-7 col-md-10">
                <h1 class="display-2 text-white">Hello {{ auth()->user()->nama }}</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
        <div class="card card-profile shadow">
            <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                    <div class="card-profile-image">
                        <a href="{{ asset(Storage::url(auth()->user()->foto_profil)) }}" data-fancybox>
                            <img id="foto_profil" src="{{asset(Storage::url(auth()->user()->foto_profil))}}" alt="{{asset(Storage::url(auth()->user()->foto_profil))}}" class="rounded-circle" style="height: 150px; width: 150px; object-fit: cover">
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-header text-center border-0 pt-md-4 pb-0 pb-md-4">
                <a id="btn-ganti-foto_profil" href="#input-foto_profil" class="btn btn-sm btn-default mt-5"><span class="fas fa-camera"></span> Ganti</a>
            </div>
            <div class="card-body pt-0 pt-md-4 pt-5">
                <div class="text-center">
                    <h3>
                        {{ auth()->user()->nama }}
                    </h3>
                    <div class="h5 font-weight-300">
                        {{ auth()->user()->email }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8 order-xl-1">
        <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Akun Saya</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('pengaturan') }}" class="btn btn-sm btn-primary">Pengaturan</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('layouts.components.alert')
                <form action="{{ route('update-profil', auth()->user()) }}" method="POST">
                    @csrf @method('patch')
                    <h6 class="heading-small text-muted mb-4">Informasi Pengguna</h6>
                    <div class="pl-lg-4">
                        <div class="form-group">
                            <label class="form-control-label" for="input-nama">Nama</label>
                            <input name="nama" type="text" id="input-nama" class="form-control form-control-alternative @error('nama') is-invalid @enderror" placeholder="Masukkan nama ..." value="{{ old('nama',auth()->user()->nama) }}">
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="input-email">Email <a href="{{ route('pengaturan') }}" class="badge badge-primary" title="Ganti email"><span class="fas fa-edit"></span></a></label>
                            <input type="email" id="input-email" class="form-control form-control-alternative" value="{{ auth()->user()->email }}" disabled>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<input type="file" name="foto_profil" id="input-foto_profil" style="display: none">
@endsection

@push('scripts')
<script src="{{ asset('js/jquery.fancybox.js') }}"></script>

<script>
    $(document).ready(function(){
        $('#btn-ganti-foto_profil').on('click', function () {
            $('#input-foto_profil').click();
        });

        $(document).on("submit","form", function () {
            $(this).children("button:submit").attr('disabled','disabled');
            $(this).children("button:submit").html(`<img height="20px" src="{{ url('/storage/loading.gif') }}" alt=""> Loading ...`);
        });

        $('#input-foto_profil').on('change', function () {
            if (this.files && this.files[0]) {
                let formData = new FormData();
                let oFReader = new FileReader();
                formData.append("foto_profil", this.files[0]);
                formData.append("_method", "patch");
                formData.append("_token", "{{ csrf_token() }}");
                oFReader.readAsDataURL(this.files[0]);

                $.ajax({
                    url: "{{ route('update-profil', auth()->user()) }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $('#img-foto_profil').attr('src', "{{ url('/storage/loading.gif') }}");
                    },
                    success: function (data) {
                        if (data.error) {
                            $('#img-foto_profil').attr('src', $("#img-foto_profil").attr('alt'));
                        } else {
                            location.reload();
                        }
                    }
                });
            }
        });
    });
</script>
@endpush
