@extends('layouts.layout')
@section('title', 'Website Resmi Pemerintah Desa '. $desa->nama_desa .' - Panduan')

@section('styles')
<meta name="description" content="Website Resmi Pemerintah Desa {{ $desa->nama_desa }}, Kecamatan {{ $desa->nama_kecamatan }}, Kabupaten {{ $desa->nama_kabupaten }}. Panduan pembuatan surat keterangan secara online">

<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
    .ikon {
        font-family: fontAwesome;
    }
</style>
@endsection

@section('header')
<h1 class="text-white text-muted">PANDUAN PENGGUNAAN APLIKASI SIMAPEDA</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-md">
        <div class="embed-responsive embed-responsive-16by9 rounded">
            <iframe class="embed-responsive-item" src="{{ url('storage/Panduan Simapeda.mp4') }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
        </div>
    </div>
</div>
@endsection
