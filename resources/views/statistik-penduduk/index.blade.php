@extends('layouts.layout')
@section('title', 'Website Resmi Pemerintah Desa '. App\Desa::find(1)->nama_desa . ' - Statistik Penduduk')

@section('styles')
<meta name="description" content="Statistik Penduduk Desa {{ App\Desa::find(1)->nama_desa }}, Kecamatan {{ App\Desa::find(1)->nama_kecamatan }}, Kabupaten {{ App\Desa::find(1)->nama_kabupaten }}.">
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/accessibility.js"></script>
@endsection

@section('header')
<h1 class="text-white text-muted">STATISTIK PENDUDUK</h1>
<p class="text-white">Statistik Penduduk Desa {{ $desa->nama_desa }}, masyarakat dapat dengan mudah mengetahui informasi mengenai statistik penduduk desa {{ $desa->nama_desa }}.</p>
@endsection

@section('content')
<div class="row">
    @include('statistik-penduduk.card')
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/statistik-penduduk.js') }}"></script>
@endpush
