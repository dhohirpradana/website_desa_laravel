@extends('layouts.app')

@section('title', 'Anggaran Pendapatan Belanja Desa')

@section('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
<style>
    .table th, .table td {
        padding: 5px;
    }
    .card .table td, .card .table th {
        padding-left: 5px;
        padding-right: 5px;
    }
</style>
@endsection

@section('content-header')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                            <div class="mb-3">
                                <h2 class="mb-0">Anggaran Pendapatan Belanja Desa</h2>
                                <p class="mb-0 text-sm">Kelola Anggaran Pendapatan Belanja Desa</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('anggaran-realisasi.create') }}?jenis={{ request('jenis') }}&tahun={{ request('tahun') }}&page={{ request('page') }}" class="btn btn-success" title="Tambah"><i class="fas fa-plus"></i> Tambah APBDes</a>
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
<div class="card shadow">
    <div class="card-body">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left mb-3">
            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill">
                    <li class="nav-item m-1">
                        <a class="nav-link tab {{ request('jenis') == 'pendapatan' ? 'active' : '' }}" href="{{ URL::current() }}?jenis=pendapatan&tahun={{ request('tahun') }}"><i class="fas fa-hand-holding-usd mr-2"></i>PENDAPATAN</a>
                    </li>
                    <li class="nav-item m-1">
                        <a class="nav-link tab {{ request('jenis') == 'belanja' ? 'active' : '' }}" href="{{ URL::current() }}?jenis=belanja&tahun={{ request('tahun') }}"><i class="fas fa-shopping-cart mr-2"></i>BELANJA</a>
                    </li>
                    <li class="nav-item m-1">
                        <a class="nav-link tab {{ request('jenis') == 'pembiayaan' ? 'active' : '' }}" href="{{ URL::current() }}?jenis=pembiayaan&tahun={{ request('tahun') }}"><i class="fas fa-money-check-alt mr-2"></i>PEMBIAYAAN</a>
                    </li>
                    <li class="nav-item m-1">
                        <a class="nav-link tab {{ request('jenis') == 'laporan' ? 'active' : '' }}" href="{{ URL::current() }}?jenis=laporan&tahun={{ request('tahun') }}"><i class="fas fa-money-check-alt mr-2"></i>Laporan</a>
                    </li>
                    <li class="nav-item m-1">
                        <a class="nav-link tab {{ request('jenis') == 'grafik' ? 'active' : '' }}" href="{{ URL::current() }}?jenis=grafik&tahun={{ request('tahun') }}"><i class="fas fa-chart-bar mr-2"></i>Grafik</a>
                    </li>
                </ul>
            </div>
            <form id="form-tahun" action="{{ URL::current()}}" method="GET">
                <input type="hidden" name="jenis" value="{{ request('jenis') ? request('jenis') : "pendapatan"}}">
                <input type="hidden" id="tahun-apbdes" value="{{ request('tahun') ? request('tahun') : date('Y')}}">
                Tahun: <input type="number" name="tahun" id="tahun" class="form-control-sm" value="{{ request('tahun') ? request('tahun') : date('Y') }}" style="width: 80px">
                <img id="loading-tahun" src="{{ asset(Storage::url('loading.gif')) }}" alt="Loading" height="20px" style="display: none">
            </form>
        </div>
        @include('anggaran-realisasi.grafik-apbdes')
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/apbdes.js') }}"></script>
<script>
    $(document).ready(function () {
        $("#tahun").change(function () {
            $("#tahun").css('display','none');
            $("#loading-tahun").css('display','');
            $(this).parent().submit();
        });
        $(".tab").click(function () {
            $("tbody").html(`<tr><td colspan="6" align="center">Loading ...</td></tr>`);
        });
    });
</script>
@endpush
