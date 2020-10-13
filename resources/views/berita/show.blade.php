@extends('layouts.layout')
@section('title', 'Desa ' . $desa->nama_desa . ' - Berita ' . $berita->judul)

@section('styles')
<meta name="description" content="Berita {{ $berita->judul }} Desa {{ $desa->nama_desa }}, Kecamatan {{ $desa->nama_kecamatan }}, Kabupaten {{ $desa->nama_kabupaten }}.">

<style>
    .animate-up:hover {
        top: -5px;
    }
</style>
@endsection

@section('header')
<h2 class="text-white text-sm text-muted">BERITA</h2>
<h1 class="text-white">{{ $berita->judul }}</h1>
@endsection

@section('content')
@if ($berita->gambar)
    <div class="row mb-5">
        <div class="col-md text-center">
            <img class="mw-100" src="{{ url(Storage::url($berita->gambar)) }}" alt="Gambar Berita {{ $berita->judul }}">
        </div>
    </div>
@endif
<div class="card">
    <div class="card-body">
        {!! $berita->konten !!}
    </div>
</div>

@if ($beritas->count() > 0)
    <h2 class="text-lead text-white text-center mt-5">Berita Lainnya</h2>
@endif
<div class="row justify-content-center mt-3">
    @foreach ($beritas as $item)
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card animate-up">
                @if ($item->gambar)
                    <a href="{{ route('berita.show', ['berita' => $item, 'slug' => Str::slug($item->judul)]) }}">
                        <div class="card-img" style="background-image: url('{{ url(Storage::url($item->gambar)) }}'); background-size: cover; height: 200px;">
                        </div>
                    </a>
                @endif
                <div class="card-body text-center">
                    <a href="{{ route('berita.show', ['berita' => $item, 'slug' => Str::slug($item->judul)]) }}">
                        <h3>{{ $item->judul }}</h3>
                        <p class="text-sm text-muted"><i class="fas fa-clock-o"></i> {{ $item->created_at->diffForHumans() }}</p>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
