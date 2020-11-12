@extends('layouts.layout')
@section('title', 'Website Resmi Pemerintah Desa '. App\Desa::find(1)->nama_desa . ' - Statistik Penduduk')

@section('styles')
<meta name="description" content="Statistik Penduduk Desa {{ App\Desa::find(1)->nama_desa }}, Kecamatan {{ App\Desa::find(1)->nama_kecamatan }}, Kabupaten {{ App\Desa::find(1)->nama_kabupaten }}.">

<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
<style>
    .table th, .table td {
        padding: 5px;
    }
    .card .table td, .card .table th {
        padding-left: 5px;
        padding-right: 5px;
    }
</style>
@endsection

@section('header')
<h1 class="text-white text-muted">LAPORAN APBDES</h1>
<p class="text-white">Laporan Anggaran Pendapatan Belanja Desa {{ $desa->nama_desa }}, masyarakat dapat dengan mudah mengetahui informasi mengenai Laporan Anggaran Pendapatan Belanja Desa {{ $desa->nama_desa }}.</p>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-body">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left mb-3">
            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill">
                    <li class="nav-item m-1">
                        <a class="nav-link tab {{ request('jenis') == 'laporan' ? 'active' : '' }}" href="{{ URL::current() }}?jenis=laporan&tahun={{ request('tahun') }}"><i class="fas fa-hand-holding-usd mr-2"></i>Laporan</a>
                    </li>
                    <li class="nav-item m-1">
                        <a class="nav-link tab {{ request('jenis') == 'grafik' ? 'active' : '' }}" href="{{ URL::current() }}?jenis=grafik&tahun={{ request('tahun') }}"><i class="fas fa-chart-bar mr-2"></i>Grafik</a>
                    </li>
                </ul>
            </div>
            <form id="form-tahun" action="{{ URL::current() }}" method="GET">
                <input type="hidden" name="jenis" value="{{ request('jenis') ? request('jenis') : "laporan"}}">
                Tahun: <input type="number" name="tahun" id="tahun" class="form-control-sm" value="{{ request('tahun') ? request('tahun') : date('Y') }}" style="width: 80px">
                <img id="loading-tahun" src="{{ asset(Storage::url('loading.gif')) }}" alt="Loading" height="20px" style="display: none">
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <th class="text-center" colspan="3">Uraian</th>
                    <th class="text-center">Anggaran</th>
                    <th class="text-center">Realisasi</th>
                    <th class="text-center">Selisih</th>
                    <th class="text-center">Persentase</th>
                </thead>
                <tbody>
                    @foreach ($detail_jenis_anggaran->groupBy('jenis_anggaran_id') as $key => $jenis_anggaran)
                        @php
                            $anggaran_jenis = 0;
                            $realisasi_jenis = 0;
                            foreach ($jenis_anggaran as $kelompok_jenis_anggaran) {
                                foreach ($kelompok_jenis_anggaran->anggaran_realisasi as $value) {
                                    $tahun = request('tahun') ? request('tahun') : date('Y');
                                    if ($value->tahun == $tahun) {
                                        $anggaran_jenis += $value->nilai_anggaran;
                                        $realisasi_jenis += $value->nilai_realisasi;
                                    }
                                }
                            }
                        @endphp
                        <tr>
                            <th colspan="7">{{ $key }}. {{ $jenis_anggaran[0]->jenis_anggaran->nama }}</th>
                        </tr>
                        @foreach ($jenis_anggaran->groupBy('kelompok_jenis_anggaran_id') as $ke => $kelompok_jenis_anggaran)
                            @php
                                $kelompok_jenis = str_split($ke);
                                $kode_kelompok_jenis_anggaran = '';
                                $anggaran_kelompok = 0;
                                $realisasi_kelompok = 0;
                                foreach ($kelompok_jenis as $value) {
                                    $kode_kelompok_jenis_anggaran .= $value . ".";
                                }
                                foreach ($kelompok_jenis_anggaran as $detail_jenis) {
                                    foreach ($detail_jenis->anggaran_realisasi as $value) {
                                        $tahun = request('tahun') ? request('tahun') : date('Y');
                                        if ($value->tahun == $tahun) {
                                            $anggaran_kelompok += $value->nilai_anggaran;
                                            $realisasi_kelompok += $value->nilai_realisasi;
                                        }
                                    }
                                }
                            @endphp
                            <tr>
                                <th>{{ $kode_kelompok_jenis_anggaran }}</th>
                                <th colspan="2">{{ $kelompok_jenis_anggaran[0]->kelompok_jenis_anggaran->nama }}</th>
                                <th class="text-right">Rp. {{ substr(number_format($anggaran_kelompok, 2, ',', '.'),0,-3) }}</th>
                                <th class="text-right">Rp. {{ substr(number_format($realisasi_kelompok, 2, ',', '.'),0,-3) }}</th>
                                <th class="text-right">Rp. {{ substr(number_format($anggaran_kelompok - $realisasi_kelompok, 2, ',', '.'),0,-3) }}</th>
                                <th class="text-right">
                                    @php
                                        try {
                                            $persen = ($realisasi_kelompok/$anggaran_kelompok) * 100;
                                            echo number_format((float)$persen, 2, '.', '') . "%";
                                        } catch (\Throwable $th) {
                                            echo "-";
                                        }
                                    @endphp
                                </th>
                            </tr>
                            @foreach ($kelompok_jenis_anggaran as $detail)
                                @php
                                    $detail_jenis = str_split($detail->id);
                                    $kode_detail_jenis_anggaran = '';
                                    $anggaran = 0;
                                    $realisasi = 0;
                                    foreach ($detail_jenis as $value) {
                                        $kode_detail_jenis_anggaran .= $value . ".";
                                    }
                                    foreach ($detail->anggaran_realisasi as $value) {
                                        $tahun = request('tahun') ? request('tahun') : date('Y');
                                        if ($value->tahun == $tahun) {
                                            $anggaran += $value->nilai_anggaran;
                                            $realisasi += $value->nilai_realisasi;
                                        }
                                    }
                                @endphp
                                @if ($detail->jenis_anggaran_id != 5)
                                    <tr>
                                        <td></td>
                                        <th>{{ $kode_detail_jenis_anggaran }}</th>
                                        <th>{{ $detail->nama }}</th>
                                        <td class="text-right">Rp. {{ substr(number_format($anggaran, 2, ',', '.'),0,-3) }}</td>
                                        <td class="text-right">Rp. {{ substr(number_format($realisasi, 2, ',', '.'),0,-3) }}</td>
                                        <td class="text-right">Rp. {{ substr(number_format($anggaran - $realisasi, 2, ',', '.'),0,-3) }}</td>
                                        <td class="text-right">
                                            @php
                                                try {
                                                    $persen = ($realisasi/$anggaran) * 100 . "%";
                                                    echo number_format((float)$persen, 2, '.', '') . "%";
                                                } catch (\Throwable $th) {
                                                    echo "-";
                                                }
                                            @endphp
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                        @if ($key != 6)
                            <tr class="bg-primary text-white font-weight-bold ">
                                <td class="text-center text-uppercase" colspan="3">Jumlah {{ $jenis_anggaran[0]->jenis_anggaran->nama }}</td>
                                <td class="text-right">Rp. {{ substr(number_format($anggaran_jenis, 2, ',', '.'),0,-3) }}</td>
                                <td class="text-right">Rp. {{ substr(number_format($realisasi_jenis, 2, ',', '.'),0,-3) }}</td>
                                <td class="text-right">Rp. {{ substr(number_format($anggaran_jenis - $realisasi_jenis, 2, ',', '.'),0,-3) }}</td>
                                <td class="text-right">
                                    @php
                                        try {
                                            $persen = ($realisasi_jenis/$anggaran_jenis) * 100;
                                            echo number_format((float)$persen, 2, '.', '') . "%";
                                        } catch (\Throwable $th) {
                                            echo "-";
                                        }
                                    @endphp
                                </td>
                            </tr>
                        @endif
                        @if ($key == 5)
                            <tr class="bg-primary text-white font-weight-bold ">
                                <td class="text-center text-uppercase" colspan="3">SURPLUS / (DEFISIT)</td>
                                <td class="text-right">Rp. {{ substr(number_format($data['pendapatan_anggaran'] - $data['belanja_anggaran'], 2, ',', '.'),0,-3) }}</td>
                                <td class="text-right">Rp. {{ substr(number_format($data['pendapatan_realisasi'] - $data['belanja_realisasi'], 2, ',', '.'),0,-3) }}</td>
                                <td class="text-right">Rp. {{ substr(number_format(($data['pendapatan_anggaran'] - $data['belanja_anggaran']) - ($data['pendapatan_realisasi'] - $data['belanja_realisasi']), 2, ',', '.'),0,-3) }}</td>
                                <td class="text-right">
                                    @php
                                        try {
                                            $persen = (($data['pendapatan_realisasi'] - $data['belanja_realisasi'])/($data['pendapatan_anggaran'] - $data['belanja_anggaran'])) * 100;
                                            echo number_format((float)$persen, 2, '.', '') . "%";
                                        } catch (\Throwable $th) {
                                            echo "-";
                                        }
                                    @endphp
                                </td>
                            </tr>
                        @elseif($key == 6)
                            <tr class="bg-primary text-white font-weight-bold ">
                                <td class="text-center text-uppercase" colspan="3">{{ $jenis_anggaran[0]->jenis_anggaran->nama }} Netto</td>
                                <td class="text-right">Rp. {{ substr(number_format($data['pembiayaan_netto_anggaran'], 2, ',', '.'),0,-3) }}</td>
                                <td class="text-right">Rp. {{ substr(number_format($data['pembiayaan_netto_realisasi'], 2, ',', '.'),0,-3) }}</td>
                                <td class="text-right">Rp. {{ substr(number_format($data['pembiayaan_netto_anggaran'] - $data['pembiayaan_netto_realisasi'], 2, ',', '.'),0,-3) }}</td>
                                <td class="text-right">
                                    @php
                                        try {
                                            $persen = ($data['pembiayaan_netto_realisasi']/$data['pembiayaan_netto_anggaran']) * 100;
                                            echo number_format((float)$persen, 2, '.', '') . "%";
                                        } catch (\Throwable $th) {
                                            echo "-";
                                        }
                                    @endphp
                                </td>
                            </tr>
                            <tr class="bg-primary text-white font-weight-bold ">
                                <td class="text-center" colspan="3">SILPA/SiLPA TAHUN BERJALAN</td>
                                <td class="text-right">Rp. {{ substr(number_format($anggaran_jenis, 2, ',', '.'),0,-3) }}</td>
                                <td class="text-right">Rp. {{ substr(number_format($data['pembiayaan_netto_realisasi'], 2, ',', '.'),0,-3) }}</td>
                                <td class="text-right">Rp. {{ substr(number_format($anggaran_jenis - $data['pembiayaan_netto_realisasi'], 2, ',', '.'),0,-3) }}</td>
                                <td class="text-right">
                                    @php
                                        try {
                                            $persen = ($data['pembiayaan_netto_realisasi']/$anggaran_jenis) * 100;
                                            echo number_format((float)$persen, 2, '.', '') . "%";
                                        } catch (\Throwable $th) {
                                            echo "-";
                                        }
                                    @endphp
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $("#tahun").change(function () {
            $("#tahun").css('display','none');
            $("#loading-tahun").css('display','');
            $(this).parent().submit();
        });
        $(".tab").click(function () {
            $("tbody").html(`<tr><td colspan="7" align="center">Loading ...</td></tr>`);
        });
    });
</script>
@endpush
