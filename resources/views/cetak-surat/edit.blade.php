@extends('layouts.app')
@section('title', 'Edit Detail Cetak Surat')

@section('content-header')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                            <div class="mb-3">
                                <h2 class="mb-0">Edit Detail Cetak Surat</h2>
                                <p class="mb-0 text-sm">Kelola Cetak Surat</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route("surat.show",$cetakSurat->surat) }}" class="btn btn-success" title="Kembali"><i class="fas fa-arrow-left"></i> Kembali</a>
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
<div class="card bg-secondary shadow border-0">
    <div class="card-body px-lg-5 py-lg-5">
        <form role="form" action="{{ route('cetakSurat.update', $cetakSurat) }}" method="POST">
            @csrf @method('patch')
            <div class="form-group mb-3">
                <label for="nomor" class="form-control-label">Nomor</label>
                <input id="nomor" class="form-control form-control-alternative" name="nomor" autofocus placeholder="Masukkan Nomor" value="{{ $cetakSurat->nomor }}">
            </div>
            @foreach ($cetakSurat->surat->isiSurat as $key => $isiSurat)
                @if ($isiSurat->jenis_isi == 3)
                    <div class="form-group mb-3">
                        <label for="{{ $isiSurat->isi .''.$key }}" class="form-control-label">{{ $isiSurat->isi }}</label>
                        <input required id="{{ $isiSurat->isi .''.$key }}" class="form-control form-control-alternative" name="isian[]" autofocus placeholder="Masukkan {{ $isiSurat->isi }}">
                    </div>
                @endif
                @if ($isiSurat->tampilkan == 1)
                    <p class="mt-5 mb-0">{{ $isiSurat->isi }}</p>
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

            @if ($cetakSurat->surat->tanda_tangan_bersangkutan == 1)
                <div class="form-group mb-3">
                    <label for="tanda_tangan_bersangkutan" class="form-control-label">Nama yang bersangkutan</label>
                    <input required id="tanda_tangan_bersangkutan" class="form-control form-control-alternative" name="isian[]" autofocus placeholder="Masukkan nama yang bersangkutan">
                </div>
            @endif

            <div class="text-center">
                <button type="submit" class="btn btn-primary my-4">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        let detailCetak = {!! json_encode($cetakSurat->detailCetak) !!};
        $.each($('[name="isian[]"]'), function (i,e){
            $(this).val(detailCetak[i].isian)
        });
    });
</script>
@endpush
