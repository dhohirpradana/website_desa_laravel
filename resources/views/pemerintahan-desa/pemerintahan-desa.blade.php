@extends('layouts.layout')
@section('title', 'Website Resmi Kelurahan ' . $desa->nama_desa . ' - Kelurahan')

@section('styles')
    <meta name="description"
        content="Macam-macam sejarah Kelurahan {{ $desa->nama_desa }}, Kecamatan {{ $desa->nama_kecamatan }}, Kabupaten {{ $desa->nama_kabupaten }}.">

    <style>
        .animate-up:hover {
            top: -5px;
        }

    </style>
@endsection

@section('header')
    <h1 class="text-white text-muted">KELURAHAN</h1>
    <p class="text-white">Kelurahan {{ $desa->nama_desa }}, masyarakat dapat dengan mudah mengetahui informasi seputar
        kelurahan {{ $desa->nama_desa }}.</p>
@endsection

@section('content')
    <div class="row justify-content-center">

        @forelse ($pemerintahan_desa as $item)
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card animate-up shadow">
                    <a
                        href="{{ route('pemerintahan-desa.show', ['pemerintahan_desa' => $item, 'slug' => Str::slug($item->judul)]) }}">
                        <div class="card-img"
                            style="background-image: url('{{ $item->gambar ? url(Storage::url($item->gambar)) : url(Storage::url('noimage.jpg')) }}'); background-size: cover; height: 200px;">
                        </div>
                    </a>
                    <div class="card-body text-center">
                        <a
                            href="{{ route('pemerintahan-desa.show', ['pemerintahan_desa' => $item, 'slug' => Str::slug($item->judul)]) }}">
                            <h3>{{ $item->judul }}</h3>
                            <div class="mt-3 d-flex justify-content-between text-sm text-muted">
                                <i class="fas fa-clock"> {{ $item->created_at->diffForHumans() }}</i>
                                <i class="fas fa-eye"> {{ $item->dilihat }} Kali Dibaca</i>
                            </div>
                        </a>
                    </div>
                </div>
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
        <div class="col-12">
            {{ $pemerintahan_desa->links() }}
        </div>
    </div>
@endsection
