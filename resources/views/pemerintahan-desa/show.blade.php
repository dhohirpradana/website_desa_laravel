@extends('layouts.layout')
@section('title', 'Desa ' . $desa->nama_desa . ' - Pemerintahan Desa ' . $pemerintahan_desa->judul)

@section('styles')
<meta name="description" content="{{ $pemerintahan_desa->judul }} Pemerintahan Desa {{ $desa->nama_desa }}, Kecamatan {{ $desa->nama_kecamatan }}, Kabupaten {{ $desa->nama_kabupaten }}.">

<style>
    .animate-up:hover {
        top: -5px;
    }
</style>
@endsection

@section('header')
<h2 class="text-white text-sm text-muted">PEMERINTAHAN DESA</h2>
<h1 class="text-white">{{ $pemerintahan_desa->judul }}</h2>
@endsection

@section('content')
@if ($pemerintahan_desa->gambar)
    <div class="row mb-5">
        <div class="col-md text-center">
            <img class="mw-100" src="{{ url(Storage::url($pemerintahan_desa->gambar)) }}" alt="Gambar Informasi Pemerintahan Desa {{ $pemerintahan_desa->judul }}">
        </div>
    </div>
@endif
<div class="card">
    <div class="card-body">
        {!! $pemerintahan_desa->konten !!}
    </div>
</div>

@if ($pemerintahan_desas->count() > 2)
    <h2 class="text-lead text-white text-center mt-5">Informasi Pemerintahan Desa Lainnya</h2>
    <div class="row justify-content-center mt-3">
        @foreach ($pemerintahan_desas as $item)
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card animate-up">
                    @if ($item->gambar)
                        <a href="{{ route('pemerintahan-desa.show', ['pemerintahan_desa' => $item, 'slug' => Str::slug($item->judul)]) }}">
                            <div class="card-img" style="background-image: url('{{ url(Storage::url($item->gambar)) }}'); background-size: cover; height: 200px;">
                            </div>
                        </a>
                    @endif
                    <div class="card-body text-center">
                        <a href="{{ route('pemerintahan-desa.show', ['pemerintahan_desa' => $item, 'slug' => Str::slug($item->judul)]) }}">
                            <h3>{{ $item->judul }}</h3>
                            <p class="text-sm text-muted"><i class="fas fa-clock-o"></i> {{ $item->created_at->diffForHumans() }}</p>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection
