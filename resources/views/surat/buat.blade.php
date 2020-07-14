@extends('layouts.layout')

@section('title')
Buat Surat {{ $surat->nama }}
@endsection

@section('header')
    <h1 class="text-white">Buat Surat</h1>
    <p class="text-lead text-light">{{ $surat->nama }}</p>
@endsection

@section('content')
<div class="row fixed-top m-3">
    <div class="col-lg-6"></div>
    <div class="col-lg-6">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="fas fa-exclamation-triangle"></i></span>
                <span class="alert-text">
                    <strong>Gagal</strong>
                    Data tidak boleh kosong!
                </span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
</div>
<div class="card bg-secondary shadow border-0">
    <div class="card-body px-lg-5 py-lg-5">
        <div class="text-center text-muted mb-4">
            <small>Buat Surat {{ $surat->nama }}</small>
        </div>
        <form role="form" action="{{ route('buat-surat.download', $surat) }}" method="POST">
            @csrf
            @foreach ($surat->isiSurat as $key => $isiSurat)
                @if ($isiSurat->isian == 1)
                    <div class="form-group mb-3">
                        <label for="{{ $isiSurat->isi .''.$key }}" class="form-control-label">{{ $isiSurat->isi }}</label>
                        <input required id="{{ $isiSurat->isi .''.$key }}" class="form-control form-control-alternative" name="isian[]" autofocus placeholder="Masukkan {{ $isiSurat->isi }}">
                    </div>
                @endif
                @php
                    $string = $isiSurat->isi;
                    preg_match_all("/\{[A-Za-z\s\(\)]+\}/", $string, $matches);
                @endphp
                @foreach ($matches[0] as $k => $value)
                    @php
                        $pertama = substr($value,1);
                        $hasil = substr($pertama,0,-1);
                    @endphp
                    <div class="form-group mb-3">
                        <label for="{{ $hasil .''.$k }}" class="form-control-label">{{ $hasil }}</label>
                        <input required id="{{ $hasil .''.$k }}" class="form-control form-control-alternative" name="isian[]" autofocus placeholder="Masukkan {{ $hasil }}">
                    </div>
                @endforeach
            @endforeach

            @if ($surat->tanda_tangan_bersangkutan == 1)
                <div class="form-group mb-3">
                    <label for="tanda_tangan_bersangkutan" class="form-control-label">Nama yang bersangkutan</label>
                    <input required id="tanda_tangan_bersangkutan" class="form-control form-control-alternative" name="isian[]" autofocus placeholder="Masukkan nama yang bersangkutan">
                </div>
            @endif

            <div class="text-center">
                <button type="submit" class="btn btn-primary my-4">Cetak</button>
            </div>
        </form>
    </div>
</div>
@endsection
