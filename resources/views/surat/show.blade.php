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
            <h2 class="mb-0">Grafik Cetak {{ $surat->nama }}</h2>
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
            <table class="table table-sm table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Nomor Surat</th>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($surat->isiSurat as $isiSurat)
                            @if ($isiSurat->jenis_isi == 3)
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
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cetakSurat as $item)
                        <tr>
                            <td>
                                <a target="_blank" href="{{ route('cetakSurat.show', $item->id) }}" class="btn btn-sm btn-success" title="Detail Cetak" data-toggle="tooltip"><i class="fas fa-print"></i></a>
                                <a href="{{ route('cetakSurat.edit',$item->id) }}" class="btn btn-sm btn-primary" title="Edit" data-toggle="tooltip"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-sm btn-danger hapus-data" data-nama="Detail cetak surat ini" data-action="{{ route('cetakSurat.destroy',$item->id) }}" data-toggle="tooltip" href="#modal-hapus" title="Hapus"><i class="fas fa-trash"></i></a>
                            </td>
                            <td>{{ $item->nomor ? $item->nomor : "-" }}</td>
                            @foreach ($item->DetailCetak as $DetailCetak)
                                <td>{{ $DetailCetak->isian }}</td>
                            @endforeach
                            <td>{{ date('d/m/Y H:i' ,strtotime($item->created_at)) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $surat->tanda_tangan_bersangkutan ? $i + 4 : $i + 3 }}" class="text-center">Data Tidak Tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $cetakSurat->links() }}
    </div>
</div>

<div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="modal-hapus" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-delete">Hapus Detail Surat?</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="heading mt-4">Perhatian!!</h4>
                    <p>Menghapus detail surat akan menghapus semua data yang dimilikinya</p>
                    <p><strong id="nama-hapus"></strong></p>
                </div>

            </div>

            <div class="modal-footer">
                <form id="form-hapus" action="" method="POST" >
                    @csrf @method('delete')
                    <button type="submit" class="btn btn-white">Yakin</button>
                </form>
                <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Tidak</button>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/plugins/chart.js/dist/Chart.min.js') }}"></script>

<script>
    const ctx = document.getElementById('chart-hari').getContext('2d');
    let chart = new Chart(ctx, {
        type: 'bar',
        data: {}
    });

    $(document).ready(function(){
        $.get("{{ route('chart-surat',$surat->id) }}", {'tahun': $("#tahun").val()}, function (response) {
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
