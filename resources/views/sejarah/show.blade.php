@extends('layouts.layout')
@section('title', 'Sejarah ' . $sejarah->judul)

@section('styles')
<style>
    .animate-up:hover {
        top: -5px;
    }
</style>
@endsection

@section('header')
<h2 class="text-white text-sm text-muted">SEJARAH</h2>
<h2 class="text-lead text-white">DESA {{ Str::upper($desa->nama_desa) }}<br/>KABUPATEN {{ Str::upper($desa->nama_kabupaten) }}</h2>
<h2 class="text-white text-sm text-muted">{{ $sejarah->judul }}</h2>
@endsection

@section('content')
@if ($sejarah->gambar)
    <div class="row mb-5">
        <div class="col-md text-center">
            <img class="mw-100" src="{{ url(Storage::url($sejarah->gambar)) }}" alt="">
        </div>
    </div>
@endif
<div class="card">
    <div class="card-body">
        {!! $sejarah->konten !!}
    </div>
</div>

@if ($sejarahs->count() > 0)
    <h2 class="text-lead text-white text-center mt-5">Sejarah Lainnya</h2>
@endif
<div class="row justify-content-center mt-3">
    @foreach ($sejarahs as $item)
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card animate-up">
                @if ($item->gambar)
                    <a href="{{ route('sejarah.show', ['sejarah' => $item, 'slug' => Str::slug($item->judul)]) }}">
                        <div class="card-img" style="background-image: url('{{ url(Storage::url($item->gambar)) }}'); background-size: cover; height: 200px;">
                        </div>
                    </a>
                @endif
                <div class="card-body text-center">
                    <a href="{{ route('sejarah.show', ['sejarah' => $item, 'slug' => Str::slug($item->judul)]) }}">
                        <h3>{{ $item->judul }}</h3>
                        <p class="text-sm text-muted"><i class="fas fa-clock-o"></i> {{ $item->created_at->diffForHumans() }}</p>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
