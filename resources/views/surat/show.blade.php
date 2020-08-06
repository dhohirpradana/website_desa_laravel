@extends('layouts.app')

@section('title', $surat->nama)

@section('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
@endsection

@section('content-header')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
                            <div class="mb-3">
                                <h2 class="mb-0">{{ $surat->nama }}</h2>
                                <p class="mb-0 text-sm">Kelola {{ $surat->nama }} {{ config('app.name') }}</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('surat.index') }}" class="btn btn-success" title="Kembali"><i class="fas fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('form-search')
<form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto" action="{{ URL::current() }}" method="GET">
    <div class="form-group mb-0">
        <div class="input-group input-group-alternative">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
            <input class="form-control" placeholder="Cari ...." type="text" name="cari" value="{{ request('cari') }}">
        </div>
    </div>
</form>
@endsection

@section('content')
@include('layouts.components.alert')
<div class="card shadow mb-3">
    <div class="card-header">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <h2 class="mb-0">Grafik Cetak Surat</h2>
            <form action="">
                <input type="number" name="tahun" id="tahun" class="form-control" value="{{ date('Y') }}">
            </form>
        </div>
    </div>
    <div class="card-body">
        <canvas id="chart-hari" class="chart-canvas"></canvas>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <div class="mb-3">
                <h2 class="mb-0">Hasil Cetak</h2>
            </div>
            <div class="mb-3">
                <h2 class="mb-0">Total : {{ count($cetakSurat) }}</h2>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive mb-3">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($surat->isiSurat as $isiSurat)
                            @if ($isiSurat->isian == 1)
                                @php
                                    $i++;
                                @endphp
                                <th class="text-center">{{ $isiSurat->isi }}</th>
                            @else
                                @php
                                    $string = $isiSurat->isi;
                                    preg_match_all("/\{[A-Za-z\s\(\)]+\}/", $string, $matches);
                                @endphp
                                @foreach ($matches[0] as $k => $value)
                                    @php
                                        $pertama = substr($value,1);
                                        $hasil = substr($pertama,0,-1);
                                        $i++;
                                    @endphp
                                    <th class="text-center">{{ $hasil }}</th>
                                @endforeach
                            @endif
                        @endforeach
                        @if ($surat->tanda_tangan_bersangkutan == 1)
                            <th class="text-center">Yang Bersangkutan</th>
                        @endif
                        <th class="text-center">Tanggal Cetak</th>
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cetakSurat as $item)
                        <tr>
                            @foreach ($item->DetailCetak as $DetailCetak)
                                <td>{{ $DetailCetak->isian }}</td>
                            @endforeach
                            <td>{{ date('d/m/Y H:i' ,strtotime($item->created_at)) }}</td>
                            <td><a href="{{ route('cetakSurat.show', $item->id) }}" class="btn btn-sm btn-success" title="Detail Cetak" data-toggle="tooltip"><i class="fas fa-print"></i></a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $i + 1 }}" class="text-center">Data Tidak Tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $cetakSurat->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/plugins/chart.js/dist/Chart.min.js') }}"></script>

<script>
    const ctx = document.getElementById('chart-hari').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {}
    });

    $(document).ready(function(){
        $(".pagination").addClass("justify-content-center");

        $.get("{{ route('chart-surat',$surat->id) }}", function (response) {
            chart.data = response;
            chart.update();
        });

        $("#tahun").change(function () {
            let form = this;
            $.get("{{ route('chart-surat',$surat->id) }}", {'tahun': $(this).val()}, function (response) {
                chart.data = response;
                chart.update();
            });
        });
    });
</script>
@endpush
