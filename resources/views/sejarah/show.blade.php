@extends('layouts.layout')
@section('title', 'Sejarah ' . $sejarah->judul)

@section('header')
<h2 class="text-white text-sm text-muted">SEJARAH</h2>
<h2 class="text-lead text-white">DESA {{ Str::upper($desa->nama_desa) }}<br/>KABUPATEN {{ Str::upper($desa->nama_kabupaten) }}</h2>
<h2 class="text-white text-sm text-muted">{{ $sejarah->judul }}</h2>
@endsection

@section('content')
@if ($sejarah->gambar)
    <div class="row mb-5">
        <div class="col-md">
            <img class="mw-100" src="{{ url(Storage::url($sejarah->gambar)) }}" alt="">
        </div>
    </div>
@endif
<div class="card">
    <div class="card-body">
        {!! $sejarah->konten !!}
    </div>
</div>
@endsection
