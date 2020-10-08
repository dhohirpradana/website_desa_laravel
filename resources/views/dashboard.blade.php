@extends('layouts.app')

@section('title', 'Dashboard')

@section('styles')
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/accessibility.js"></script>
@endsection

@section('content-header')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Kepala Keluarga</h5>
                                <span class="h2 font-weight-bold mb-0">{{ $totalPenduduk->where('status_hubungan_dalam_keluarga_id',1)->count() }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Penduduk</h5>
                                <span class="h2 font-weight-bold mb-0">{{ $totalPenduduk->count() }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Laki-laki</h5>
                                <span class="h2 font-weight-bold mb-0">{{ $totalPenduduk->where('jenis_kelamin',1)->count() }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Perempuan</h5>
                                <span class="h2 font-weight-bold mb-0">{{ $totalPenduduk->where('jenis_kelamin',2)->count() }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-pink text-white rounded-circle shadow">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Cetak Surat Hari Ini</h5>
                                <span class="h2 font-weight-bold mb-0">{{ $hari }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Cetak Surat Bulan Ini</h5>
                                <span class="h2 font-weight-bold mb-0">{{ $bulan }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Cetak Surat Tahun Ini</h5>
                                <span class="h2 font-weight-bold mb-0">{{ $tahun }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Cetak Surat</h5>
                                <span class="h2 font-weight-bold mb-0">{{ $totalCetakSurat }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header">
                <div
                    class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
                    <div class="mb-1">
                        <h2 class="mb-0">Grafik Cetak Surat Harian</h2>
                    </div>
                    <div class="mb-1">
                        <input type="date" name="tanggal" id="tanggal" class="form-control-sm" value="{{ date('Y-m-d') }}">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="chart-harian" style="height: 400px; margin: 0 auto"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header font-weight-bold">
                <div
                    class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
                    <div class="mb-1">
                        <h2 class="mb-0">Grafik Cetak Surat Bulanan</h2>
                    </div>
                    <div class="mb-1">
                        <input type="month" name="bulan" id="bulan" class="form-control-sm" value="{{ date('Y-m') }}">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="chart-bulanan" style="height: 400px; margin: 0 auto"></div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-4">
        <div class="card shadow h-100">
            <div class="card-header font-weight-bold">
                <div
                    class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
                    <div class="mb-1">
                        <h2 class="mb-0">Grafik Cetak Surat Tahunan</h2>
                    </div>
                    <div class="mb-1">
                        Tahun : <input type="number" name="tahun" id="tahun" class="form-control-sm" value="{{ date('Y') }}" style="width:80px">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="chart-tahunan" style="height: 400px; margin: 0 auto"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-body">
                <div id="chart-agama"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-body">
                <div id="chart-darah"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-body">
                <div id="chart-perkawinan"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-body">
                <div id="chart-pendidikan"></div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-4">
        <div class="card shadow h-100">
            <div class="card-body">
                <div id="chart-usia"></div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-4">
        <div class="card shadow h-100">
            <div class="card-body">
                <div id="chart-pekerjaan" style="height: 400px; margin: 0 auto"></div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-4">
        <div class="card shadow h-100">
            <div class="card-header">
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
                    <div class="mb-1">
                        <h2 class="mb-0">Grafik Pelaksanaan APBDes</h2>
                    </div>
                    <div class="mb-1">
                        Tahun : <input type="number" name="tahun-apbdes" id="tahun-apbdes" class="form-control-sm" value="{{ date('Y') }}" style="width:80px">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-12 mb-3">
                        <div class="text-center">
                            <h3 class="mb-0">PELAKSANAAN</h3>
                            <p class="text-sm mb-0">Realisasi | Anggaran</p>
                        </div>
                        <div class="progress-wrapper">
                            <div class="progress-info">
                                <div class="progress-label">
                                    <span>Pendapatan</span>
                                    <span id="pendapatan-uang">Rp. 0 | Rp. 0</span>
                                </div>
                                <div class="progress-percentage">
                                    <span id="pendapatan-persen">0%</span>
                                </div>
                            </div>
                            <div class="progress">
                                <div id="pendapatan-value" class="progress-bar bg-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                            </div>
                        </div>
                        <div class="progress-wrapper">
                            <div class="progress-info">
                                <div class="progress-label">
                                    <span>Belanja</span>
                                    <span id="belanja-uang">Rp. 0 | Rp. 0</span>
                                </div>
                                <div class="progress-percentage">
                                    <span id="belanja-persen">0%</span>
                                </div>
                            </div>
                            <div class="progress">
                                <div id="belanja-value" class="progress-bar bg-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                            </div>
                        </div>
                        <div class="progress-wrapper">
                            <div class="progress-info">
                                <div class="progress-label">
                                    <span>Pembiayaan</span>
                                    <span id="pembiayaan-uang">Rp. 0 | Rp. 0</span>
                                </div>
                                <div class="progress-percentage">
                                    <span id="pembiayaan-persen">0%</span>
                                </div>
                            </div>
                            <div class="progress">
                                <div id="pembiayaan-value" class="progress-bar bg-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="text-center">
                            <h3 class="mb-0">PENDAPATAN</h3>
                            <p class="text-sm mb-0">Realisasi | Anggaran</p>
                        </div>
                        <div id="pendapatan-wrapper"></div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="text-center">
                            <h3 class="mb-0">BELANJA</h3>
                            <p class="text-sm mb-0">Realisasi | Anggaran</p>
                        </div>
                        <div id="belanja-wrapper"></div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="text-center">
                            <h3 class="mb-0">PEMBIAYAAN</h3>
                            <p class="text-sm mb-0">Realisasi | Anggaran</p>
                        </div>
                        <div id="pembiayaan-wrapper"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/apbdes.js') }}"></script>
<script>
    let pie = {
        chart: {
            type: 'pie'
        },
        subtitle: {
            text: "Total Penduduk: {{ $totalPenduduk->count() }}"
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.y:f}'
                }
            },
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                showInLegend: true
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:f}</b><br/>'
        },

        series: [
            {
                name: "Agama",
                colorByPoint: true,
                shadow:1,
                border:1,
                data: []
            }
        ]
    }

    let bar = {
        chart: {
            type: 'bar',
        },
        xAxis: {
            type: 'category',
            title: {
                text: null
            },
            min: 0,
            max: 4,
            scrollbar: {
                enabled: true
            },
            tickLength: 0
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Cetak',
                align: 'high'
            }
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            enabled: false
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Jumlah Cetak',
            data: []
        }]
    };

    let chart_agama = Highcharts.chart('chart-agama', pie);
    chart_agama.title.textSetter("Grafik Agama");
    chart_agama.series[0].setData({!! json_encode($agama) !!});

    let chart_darah = Highcharts.chart('chart-darah', pie);
    chart_darah.title.textSetter("Grafik Darah");
    chart_darah.series[0].setData({!! json_encode($darah) !!});

    let chart_pendidikan = Highcharts.chart('chart-pendidikan', pie);
    chart_pendidikan.title.textSetter("Grafik Pendidikan");
    chart_pendidikan.series[0].setData({!! json_encode($pendidikan) !!});

    let chart_perkawinan = Highcharts.chart('chart-perkawinan', pie);
    chart_perkawinan.title.textSetter("Grafik Perkawinan");
    chart_perkawinan.series[0].setData({!! json_encode($perkawinan) !!});

    Highcharts.chart('chart-usia', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Usia'
        },
        subtitle: {
            text: 'Total Penduduk : {{ $totalPenduduk->count() }}'
        },
        xAxis: {
            categories: {!! json_encode($usia['kategori']) !!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Penduduk'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b> {point.y}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: "Laki - laki",
            data: {!! json_encode($usia['laki']) !!}

        }, {
            name: "Perempuan",
            data: {!! json_encode($usia['perempuan']) !!}
        }]
    });

    let chart_pekerjaan = Highcharts.chart('chart-pekerjaan', {
        chart: {
            type: 'bar',
            marginLeft: 150
        },
        title: {
            text: 'Grafik Pekerjaan'
        },
        subtitle: {
            text: "Total Penduduk: {{ $totalPenduduk->count() }}"
        },
        xAxis: {
            type: 'category',
            title: {
            text: null
            },
            min: 0,
            max: 7,
            scrollbar: {
                enabled: true
            },
            tickLength: 0
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Penduduk',
                align: 'high'
            }
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            enabled: false
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Jumlah Penduduk',
            data: {!! json_encode($pekerjaan) !!}
        }]
    });

    let chart_harian = Highcharts.chart('chart-harian', bar);
    chart_harian.title.textSetter("Grafik Cetak Surat Harian");

    let chart_bulanan = Highcharts.chart('chart-bulanan', bar);
    chart_bulanan.title.textSetter("Grafik Cetak Surat Bulanan");

    let chart_tahunan = Highcharts.chart('chart-tahunan', bar);
    chart_tahunan.title.textSetter("Grafik Cetak Surat Tahunan");

    $(document).ready(function(){
        $(".form-control").change(function () {
            $(this).parent().submit();
        });

        $.get("{{ route('surat-harian') }}", function (response) {
            chart_harian.series[0].setData(response);
        });

        $.get("{{ route('surat-bulanan') }}", function (response) {
            chart_bulanan.series[0].setData(response);
        });

        $.get("{{ route('surat-tahunan') }}", function (response) {
            chart_tahunan.series[0].setData(response);
        });

        $("#tanggal").change(function () {
            $.get("{{ route('surat-harian') }}", {'tanggal': $(this).val()}, function (response) {
                chart_harian.series[0].setData(response);
            });
        });

        $("#bulan").change(function () {
            $.get("{{ route('surat-bulanan') }}", {'bulan': $(this).val()}, function (response) {
                chart_bulanan.series[0].setData(response);
            });
        });

        $("#tahun").change(function () {
            let form = this;
            $.get("{{ route('surat-tahunan') }}", {'tahun': $(this).val()}, function (response) {
                chart_tahunan.series[0].setData(response);
            });
        });
    });
</script>
@endpush
