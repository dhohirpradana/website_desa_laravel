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
    @forelse ($gallery as $item)
        <div class="col-lg-4 col-md-6 mb-3 animate-up">
            <a href="{{ url(Storage::url($item->gallery)) }}" data-fancybox data-caption="{{ $item->caption }}">
                <img class="mw-100" src="{{ url(Storage::url($item->gallery)) }}" alt="">
            </a>
        </div>
    @empty
        <div class="col">
            <div class="card">
                <div class="card-body text-center">
                    <h3>Data belum tersedia</h3>
                </div>
            </div>
        </div>
    @endforelse
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/jquery.fancybox.js') }}"></script>
@endpush
