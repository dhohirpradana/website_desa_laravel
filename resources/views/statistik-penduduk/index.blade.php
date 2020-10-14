@extends('layouts.layout')
@section('title', 'Website Resmi Pemerintah Desa '. App\Desa::find(1)->nama_desa . ' - Statistik Penduduk')

@section('styles')
<meta name="description" content="Statistik Penduduk Desa {{ App\Desa::find(1)->nama_desa }}, Kecamatan {{ App\Desa::find(1)->nama_kecamatan }}, Kabupaten {{ App\Desa::find(1)->nama_kabupaten }}.">
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/accessibility.js"></script>
@endsection

@section('header')
<h1 class="text-white text-muted">STATISTIK PENDUDUK</h1>
<p class="text-white">Statistik Penduduk Desa {{ $desa->nama_desa }}, masyarakat dapat dengan mudah mengetahui informasi mengenai statistik penduduk desa {{ $desa->nama_desa }}.</p>
@endsection

@section('content')
<div class="row">
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
</div>
@endsection

@push('scripts')
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

</script>
@endpush
