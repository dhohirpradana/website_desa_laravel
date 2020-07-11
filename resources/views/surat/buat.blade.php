@extends('layouts.layout')

@section('title')
Buat Surat {{ $surat->nama }}
@endsection

@section('header')
    <h1 class="text-white">Buat Surat</h1>
    <p class="text-lead text-light">{{ $surat->nama }}</p>
@endsection

@section('content')
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
                        <input id="{{ $isiSurat->isi .''.$key }}" class="form-control form-control-alternative @error($isiSurat->isi) is-invalid @enderror" name="{{ $isiSurat->isi }}" required autofocus placeholder="Masukkan {{ $isiSurat->isi }}">
                        @error($isiSurat->isi)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                @endif
                @php
                    $string = $isiSurat->isi;
                    preg_match_all("/\{[A-Za-z_]+\}/", $string, $matches);
                @endphp
                @foreach ($matches[0] as $k => $value)
                    @php
                        $pertama = substr($value,1);
                        $hasil = str_replace('_',' ',substr($pertama,0,-1));
                    @endphp
                    <div class="form-group mb-3">
                        <label for="{{ $hasil .''.$k }}" class="form-control-label">{{ $hasil }}</label>
                        <input id="{{ $hasil .''.$k }}" class="form-control form-control-alternative @error($hasil) is-invalid @enderror" name="{{ $hasil }}" required autofocus placeholder="Masukkan {{ $hasil }}">
                        @error($hasil)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                @endforeach
            @endforeach
            <div class="text-center">
                <button type="submit" class="btn btn-primary my-4">Cetak</button>
            </div>
        </form>
    </div>
</div>
@endsection
