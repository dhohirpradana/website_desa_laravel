@extends('layouts.layout')
@section('title', 'Website Resmi Pemerintah Desa ' . $desa->nama_desa . ' - Beranda')

@section('styles')
    <meta name="description"
        content="Website Resmi Pemerintah Desa {{ $desa->nama_desa }}, Kecamatan {{ $desa->nama_kecamatan }}, Kabupaten {{ $desa->nama_kabupaten }}. Melayani pembuatan surat keterangan secara online">

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <style>
        .ikon {
            font-family: fontAwesome;
        }

        .progress-label>span {
            color: white;
        }

        .progress-percentage>span {
            color: white;
        }

        .judul {
            color: white;
        }

        .animate-up:hover {
            top: -5px;
        }

    </style>
@endsection

@section('header')
    <h1 class="text-white text-sm text-muted">SELAMAT DATANG DI WEBSITE RESMI</h1>
    <h2 class="text-lead text-white">
        <b><strong>DESA {{ Str::upper($desa->nama_desa) }} <br> KECAMATAN
                {{ Str::upper($desa->nama_kecamatan) }} <br />KABUPATEN
                {{ Str::upper($desa->nama_kabupaten) }}</strong></b>
    </h2>
@endsection

@section('content')
    <div class="row">
        <div class="col-md">
            <div id="owl-one" class="owl-carousel owl-theme" style="z-index: 0">
                @foreach ($gallery as $key => $item)
                    <a class="text-center" href="{{ asset(Storage::url($item->gallery)) }}"
                        data-caption="{{ $item->caption }}" data-fancybox>
                        <img src="{{ asset(Storage::url($item->gallery)) }}" alt="Slide Show {{ $key }}"
                            style="max-height: 600px; object-fit: contain;">
                        <p class="text-center text-white">{{ $item->caption }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    @if ($surat->count() > 0)
        <section class="mb-5">
            <div class="row">
                <div class="col-md">
                    <div class="header-body text-center mt-5 mb-3">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-6 border-bottom">
                                <h2 class="text-white">LAYANAN SURAT</h2>
                                <p class="text-white">Dengan menggunakan layanan surat website Desa
                                    {{ $desa->nama_desa }}, masyarakat dapat dengan mudah membuat beberapa surat
                                    keterangan berikut ini secara online.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4 justify-content-center">
                @foreach ($surat as $item)
                    <div class="col-lg-4 col-md-6 surats">
                        <div class="single-service bg-white rounded shadow p-3 animate-up">
                            <a href="{{ route('buat-surat', ['id' => $item->id, 'slug' => Str::slug($item->nama)]) }}">
                                <i class="fas {{ $item->icon }} ikon fa-5x mb-3"></i>
                                <h4>{{ $item->nama }}</h4>
                            </a>
                            <p>{{ $item->deskripsi }}</p>
                        </div>
                    </div>
                @endforeach
                @if (App\Surat::count() > 3)
                    <a href="{{ route('layanan-surat') }}" class="btn btn-primary">Lebih Banyak Surat</a>
                @endif
            </div>
        </section>
    @endif
    <div class="card shadow h-100 mb-5" style="margin-top:100px">
        <div class="card-header">
            <div
                class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
                <div class="mb-1">
                    <h2 class="mb-0">Grafik Pelaksanaan APBDes</h2>
                </div>
                <div class="mb-1">
                    Tahun : <input type="number" name="tahun-apbdes" id="tahun-apbdes" class="form-control-sm"
                        value="{{ date('Y') }}" style="width:80px">
                    <img id="loading-tahun" src="{{ asset(Storage::url('loading.gif')) }}" alt="Loading" height="20px"
                        style="display: none">
                </div>
            </div>
        </div>
        <div class="card-body bg-default text-white">
            @include('anggaran-realisasi.grafik-apbdes')
        </div>
    </div>
    @if ($berita->count() > 0)
        <section class="mb-5">
            <div class="row">
                <div class="col-md">
                    <div class="header-body text-center mt-5 mb-3">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-6 border-bottom">
                                <h2 class="text-white">BERITA</h2>
                                <p class="text-white">Berita seputar desa {{ $desa->nama_desa }}.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach ($berita as $item)
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card animate-up shadow">
                            <a href="{{ route('berita.show', ['berita' => $item, 'slug' => Str::slug($item->judul)]) }}">
                                <div class="card-img"
                                    style="background-image: url('{{ $item->gambar ? url(Storage::url($item->gambar)) : url(Storage::url('noimage.jpg')) }}'); background-size: cover; height: 200px;">
                                </div>
                            </a>
                            <div class="card-body text-center">
                                <a
                                    href="{{ route('berita.show', ['berita' => $item, 'slug' => Str::slug($item->judul)]) }}">
                                    <h3>{{ $item->judul }}</h3>
                                    <div class="mt-3 d-flex justify-content-between text-sm text-muted">
                                        <i class="fas fa-clock"> {{ $item->created_at->diffForHumans() }}</i>
                                        <i class="fas fa-eye"> {{ $item->dilihat }} Kali Dibaca</i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if (App\Berita::count() > 3)
                <div class="text-center">
                    <a href="{{ route('berita') }}" class="btn btn-primary">Lebih Banyak Berita</a>
                </div>
            @endif
        </section>
    @endif
    @if ($pemerintahan_desa->count() > 0)
        <section class="mb-5">
            <div class="row">
                <div class="col-md">
                    <div class="header-body text-center mt-5 mb-3">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-6 border-bottom">
                                <h2 class="text-white">Pemerintahan Desa</h2>
                                <p class="text-white">Pemerintahan Desa {{ $desa->nama_desa }}, masyarakat dapat dengan
                                    mudah mengetahui informasi seputar pemerintahan desa {{ $desa->nama_desa }}.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach ($pemerintahan_desa as $item)
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
                @endforeach
            </div>
            @if (App\PemerintahanDesa::count() > 3)
                <div class="text-center">
                    <a href="{{ route('pemerintahan-desa') }}" class="btn btn-primary">Lebih Banyak Informasi
                        Pemerintahan Desa</a>
                </div>
            @endif
        </section>
    @endif
    @if (count($galleries) > 0)
        <section class="mb-5">
            <div class="row">
                <div class="col-md">
                    <div class="header-body text-center mt-5 mb-3">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-6 border-bottom">
                                <h2 class="text-white">GALLERY</h2>
                                <p class="text-white">Gallery Desa {{ $desa->nama_desa }}, masyarakat dapat dengan mudah
                                    mengetahui gallery desa {{ $desa->nama_desa }}.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach ($galleries as $key => $item)
                    @if ($key < 3)
                        @if ($item['jenis'] == 1) <div class="col-lg-4 col-md-6 mb-3
                        img-scale-up">
                        <a href="{{ url(Storage::url($item['gambar'])) }}" data-fancybox
                        data-caption="{{ $item['caption'] }}">
                        <img class="mw-100" src="{{ url(Storage::url($item['gambar'])) }}"
                        alt="">
                        </a>
                        </div>
                    @else
                        <div class="col-lg-4 col-md-6 mb-3 img-scale-up">
                        <a href="https://www.youtube.com/watch?v={{ $item['id'] }}" data-fancybox
                        data-caption="{{ $item['caption'] }}">
                        <i class="fas fa-play fa-2x" style="position: absolute; top:43%;
                        left:46%;"></i>
                        <img class="mw-100" src="{{ $item['gambar'] }}" alt="">
                        </a>
                        </div> @endif
                    @endif
                @endforeach
            </div>
            @if (count($galleries) > 6)
                <div class="text-center">
                    <a href="{{ route('gallery') }}" class="btn btn-primary">Lebih Banyak Gallery</a>
                </div>
            @endif
        </section>
    @endif
    <div class="mapouter">
        <div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0"
                marginwidth="0"
                src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=Mlati norowito&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
        </div>
        <style>
            .mapouter {
                position: relative;
                text-align: right;
                width: 100%;
                height: 400px;
            }

            .gmap_canvas {
                overflow: hidden;
                background: none !important;
                width: 100%;
                height: 400px;
            }

            .gmap_iframe {
                height: 400px !important;
            }

        </style>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('js/apbdes.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#owl-one').owlCarousel({
                loop: true,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                smartSpeed: 1000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            });
        });

    </script>
@endpush
