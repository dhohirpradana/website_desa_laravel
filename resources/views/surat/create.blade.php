@extends('layouts.app')

@section('title', 'Tambah Surat')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
    .ikon {
        font-family: fontAwesome;
    }
</style>
@endsection

@section('content-header')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
                            <div class="mb-3">
                                <h2 class="mb-0">Tambah Surat</h2>
                                <p class="mb-0 text-sm">Kelola Surat {{ config('app.name') }}</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('surat.index') }}" class="btn btn-success" title="Kembali"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                <h3 class="mb-0">Tambah Surat</h3>
            </div>
            <div class="card-body">
                <form autocomplete="off" action="{{ route("surat.store") }}" method="post" data-redirect="{{ route('surat.index') }}">
                    @csrf
                    <input type="hidden" class="form-control form-control-alternative" name="isian[]" value="isian">
                    <input type="hidden" id="urutan" value="1">
                    <input type="hidden" name="jenis_isi[]" value="0">
                    <input type="hidden" name="tampilkan[]" value="0">
                    <h6 class="heading-small text-muted">Detail Surat</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Nama Surat</label>
                                    <input class="form-control form-control-alternative" name="nama">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Icon</label>
                                    @include('layouts.components.icon')
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Deskripsi</label>
                            <textarea class="form-control form-control-alternative" name="deskripsi"></textarea>
                        </div>
                    </div>
                    <h6 class="heading-small text-muted mt-4">Isian</h6>
                    <div class="pl-lg-4" id="isian"></div>
                    <h6 class="heading-small text-muted">Alat</h6>
                    <div class="pl-lg-4">
                        @include('surat.button-alat')
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="tampilkan_surat" name="tampilkan_surat" value="1">
                            <label class="custom-control-label" for="tampilkan_surat">Tampilkan surat ini untuk warga yang ingin mencetak surat keterangan ini</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="perihal" name="perihal" value="1">
                            <label class="custom-control-label" for="perihal">Perihal</label> <a href="{{ url('img/bantuan-perihal.png') }}" data-fancybox data-caption="Akan menampilkan surat seperti ini"><i class="fas fa-question-circle text-blue" title="Bantuan" data-toggle="tooltip"></i></a>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="data_kades" name="data_kades" value="1">
                            <label class="custom-control-label" for="data_kades">Data Kades</label> <a href="{{ url('img/bantuan-data-kades.png') }}" data-fancybox data-caption="Akan menampilkan data kepala desa"><i class="fas fa-question-circle text-blue" title="Bantuan" data-toggle="tooltip"></i></a>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="tanda_tangan_bersangkutan" name="tanda_tangan_bersangkutan" value="1">
                            <label class="custom-control-label" for="tanda_tangan_bersangkutan">Tanda tangan bersangkutan</label> <a href="{{ url('img/bantuan-tanda-tangan-bersangkutan.png') }}" data-fancybox data-caption="Akan menampilkan tanda tangan yang bersangkutan"><i class="fas fa-question-circle text-blue" title="Bantuan" data-toggle="tooltip"></i></a>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary btn-block" id="simpan">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('js/surat.js') }}"></script>
<script>
    $(document).ready(function(){
        $(".ikon").val("fa-file-text-o");
    });
</script>
@endpush
