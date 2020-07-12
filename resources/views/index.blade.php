@extends('layouts.layout')
@section('title', 'Beranda')

@section('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
    .ikon {
        font-family: fontAwesome;
    }
</style>
@endsection

@section('header')
<h2 class="text-white text-sm text-muted">SELAMAT DATANG DI LAYANAN ONLINE</h2>
<h2 class="text-lead text-white">DESA {{ Str::upper($desa->nama_desa) }}<br/>KABUPATEN {{ Str::upper($desa->nama_kabupaten) }}</h2>
@endsection

@section('content')
<div class="row">
    <div class="col-md">
        <div class="embed-responsive embed-responsive-16by9 rounded">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/84mxPd0Ma8Q" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
        </div>
    </div>
</div>
<section id="services">
    <div class="row">
        <div class="col-md">
            <div class="header-body text-center mt-5 mb-3">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-6 border-bottom">
                        <h2 class="text-white">LAYANAN</h2>
                        <p class="text-white">Dengan menggunakan Aplikasi {{ config('app.name') }}, masyarakat dapat dengan mudah mengajukan beberapa layanan berikut ini secara online.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4 justify-content-center">
        @forelse ($surat as $item)
            <div class="col-lg-4 col-md-6">
                <div class="single-service bg-white rounded shadow p-3">
                    <a href="{{ route('buat-surat', ['id' => $item->id,'slug' => Str::slug($item->nama)]) }}">
                        <i class="fas {{ $item->icon }} ikon fa-5x mb-3"></i>
                        <h4>{{ $item->nama }}</h4>
                    </a>
                    <p>{{ $item->deskripsi }}</p>
                </div>
            </div>
        @empty
            <div class="col">
                <div class="single-service bg-white rounded shadow">
                    <h4>Data belum tersedia</h4>
                </div>
            </div>
        @endforelse
    </div>
</section>
@endsection
