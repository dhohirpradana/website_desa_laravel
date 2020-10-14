@extends('layouts.layout')
@section('title', 'Website Resmi Pemerintah Desa '. $desa->nama_desa . ' - Gallery')

@section('styles')
<meta name="description" content="Gallery Desa {{ $desa->nama_desa }}, Kecamatan {{ $desa->nama_kecamatan }}, Kabupaten {{ $desa->nama_kabupaten }}">

<link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('header')
<h1 class="text-white text-muted">GALLERY</h1>
<p class="text-white">Gallery Desa {{ $desa->nama_desa }}, masyarakat dapat dengan mudah mengetahui informasi mengenai macam-macam gallery desa {{ $desa->nama_desa }}.</p>
@endsection

@section('content')
<div class="row justify-content-center">
    @forelse ($galleries as $item)
        @if ($item['jenis'] == 1)
            <div class="col-lg-4 col-md-6 mb-3 img-scale-up">
                <a href="{{ url(Storage::url($item['gambar'])) }}" data-fancybox data-caption="{{ $item['caption'] }}">
                    <img class="mw-100" src="{{ url(Storage::url($item['gambar'])) }}" alt="">
                </a>
            </div>
        @else
            <div class="col-lg-4 col-md-6 mb-3 img-scale-up">
                <a href="https://www.youtube.com/watch?v={{ $item['id'] }}" data-fancybox data-caption="{{ $item['caption'] }}">
                    <i class="fas fa-play fa-2x" style="position: absolute; top:43%; left:46%;"></i>
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
