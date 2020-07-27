@extends('layouts.layout')
@section('title', 'Sejarah')

@section('header')
<h2 class="text-white text-sm text-muted">SEJARAH</h2>
<h2 class="text-lead text-white">DESA {{ Str::upper($desa->nama_desa) }}<br/>KABUPATEN {{ Str::upper($desa->nama_kabupaten) }}</h2>
@endsection

@section('content')
<div class="row justify-content-center">

    @forelse ($sejarah as $item)
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card">
                @if ($item->gambar)
                    <div class="card-img">
                        <a href="{{ route('sejarah.show', ['sejarah' => $item, 'slug' => Str::slug($item->judul)]) }}">
                            <img class="mw-100" src="{{ url(Storage::url($item->gambar)) }}" alt="">
                        </a>
                    </div>
                @endif
                <div class="card-body text-center">
                    <a href="{{ route('sejarah.show', ['sejarah' => $item, 'slug' => Str::slug($item->judul)]) }}">
                        <h3>{{ $item->judul }}</h3>
                        <p class="text-sm text-muted"><i class="fas fa-clock-o"></i> {{ $item->created_at->diffForHumans() }}</p>
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
</div>
@endsection
