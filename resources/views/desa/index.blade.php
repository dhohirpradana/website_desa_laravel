@extends('layouts.app')

@section('title')
Profil Desa
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
                <h1 class="display-2 text-white">Desa {{ $desa->nama_desa }}</h1>
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
                        <a href="{{ asset(Storage::url($desa->logo)) }}" data-fancybox>
                            <img id="logo" src="{{ asset(Storage::url($desa->logo)) }}" alt="{{ asset(Storage::url($desa->logo)) }}" class="rounded-circle" style="height: 150px; width: 150px; object-fit: cover">
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-header text-center border-0 pt-md-4 pb-0 pb-md-4">
                <a id="btn-ganti-logo" href="#input-logo" class="btn btn-sm btn-default mt-5"><span class="fas fa-camera"></span> Ganti</a>
            </div>
            <div class="card-body pt-0 pt-md-4 pt-5">
                <div class="text-center">
                    <h3>
                        Desa {{ $desa->nama_desa }}
                    </h3>
                    <div class="h5 font-weight-300">
                        Kec. {{ $desa->nama_kecamatan }}, Kab. {{ $desa->nama_kabupaten }}
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
                        <h3 class="mb-0">Informasi Profil Desa</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('layouts.components.alert')
                <form action="{{ route('update-desa', $desa) }}" method="POST">
                    @csrf @method('patch')
                    <div class="form-group">
                        <label class="form-control-label" for="nama_desa">Nama Desa</label>
                        <input name="nama_desa" type="text" id="nama_desa" class="form-control form-control-alternative @error('nama_desa') is-invalid @enderror" placeholder="Masukkan nama desa" value="{{ old('nama_desa',$desa->nama_desa) }}">
                        @error('nama_desa')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="nama_kecamatan">Nama Kecamatan</label>
                        <input name="nama_kecamatan" type="text" id="nama_kecamatan" class="form-control form-control-alternative @error('nama_kecamatan') is-invalid @enderror" placeholder="Masukkan nama desa" value="{{ old('nama_kecamatan',$desa->nama_kecamatan) }}">
                        @error('nama_kecamatan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="nama_kabupaten">Nama Kabupaten</label>
                        <input name="nama_kabupaten" type="text" id="nama_kabupaten" class="form-control form-control-alternative @error('nama_kabupaten') is-invalid @enderror" placeholder="Masukkan nama desa" value="{{ old('nama_kabupaten',$desa->nama_kabupaten) }}">
                        @error('nama_kabupaten')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="alamat">Alamat</label>
                        <input name="alamat" type="text" id="alamat" class="form-control form-control-alternative @error('alamat') is-invalid @enderror" placeholder="Masukkan nama desa" value="{{ old('alamat',$desa->alamat) }}">
                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="nama_kepala_desa">Nama Kepala Desa</label>
                        <input name="nama_kepala_desa" type="text" id="nama_kepala_desa" class="form-control form-control-alternative @error('nama_kepala_desa') is-invalid @enderror" placeholder="Masukkan nama desa" value="{{ old('nama_kepala_desa',$desa->nama_kepala_desa) }}">
                        @error('nama_kepala_desa')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="alamat_kepala_desa">Alamat Kepala Desa</label>
                        <input name="alamat_kepala_desa" type="text" id="alamat_kepala_desa" class="form-control form-control-alternative @error('alamat_kepala_desa') is-invalid @enderror" placeholder="Masukkan nama desa" value="{{ old('alamat_kepala_desa',$desa->alamat_kepala_desa) }}">
                        @error('alamat_kepala_desa')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<input type="file" name="logo" id="input-logo" style="display: none">
@endsection

@push('scripts')
<script src="{{ asset('js/jquery.fancybox.js') }}"></script>

<script>
    $(document).ready(function(){
        $('#btn-ganti-logo').on('click', function () {
            $('#input-logo').click();
        });

        $(document).on("submit","form", function () {
            $(this).children("button:submit").attr('disabled','disabled');
            $(this).children("button:submit").html(`<img height="20px" src="{{ url('/storage/loading.gif') }}" alt=""> Loading ...`);
        });

        $('#input-logo').on('change', function () {
            if (this.files && this.files[0]) {
                let formData = new FormData();
                let oFReader = new FileReader();
                formData.append("logo", this.files[0]);
                formData.append("_method", "patch");
                formData.append("_token", "{{ csrf_token() }}");
                oFReader.readAsDataURL(this.files[0]);

                $.ajax({
                    url: "{{ route('update-desa', $desa) }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $('#img-logo').attr('src', "{{ url('/storage/loading.gif') }}");
                    },
                    success: function (data) {
                        if (data.error) {
                            $('#img-logo').attr('src', $("#img-logo").attr('alt'));
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
