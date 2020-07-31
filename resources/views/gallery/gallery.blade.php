@extends('layouts.layout')
@section('title', 'Gallery')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
<style>
    .animate-up:hover {
        top: -5px;
    }
</style>
@endsection

@section('header')
<h2 class="text-white text-sm text-muted">GALLERY</h2>
<h2 class="text-lead text-white">DESA {{ Str::upper($desa->nama_desa) }}<br/>KABUPATEN {{ Str::upper($desa->nama_kabupaten) }}</h2>
@endsection

@section('content')
<div class="row justify-content-center">
    @forelse ($galleries as $item)
        @if ($item['jenis'] == 1)
            <div class="col-lg-4 col-md-6 mb-3 animate-up">
                <a href="{{ url(Storage::url($item['gambar'])) }}" data-fancybox data-caption="{{ $item['caption'] }}">
                    <img class="mw-100" src="{{ url(Storage::url($item['gambar'])) }}" alt="">
                </a>
            </div>
        @else
            <div class="col-lg-4 col-md-6 mb-3 animate-up">
                <a href="https://www.youtube.com/watch?v={{ $item['id'] }}" data-fancybox data-caption="{{ $item['caption'] }}">
                    <i class="fas fa-play fa-2x" style="position: absolute; top:45%; left:48%;"></i>
                    <img class="mw-100" src="{{ $item['gambar'] }}" alt="">
                </a>
            </div>
        @endif
    @empty
        <div class="col">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h4>Data belum tersedia</h4>
                </div>
            </div>
        </div>
    @endforelse
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/jquery.fancybox.js') }}"></script>
@endpush
