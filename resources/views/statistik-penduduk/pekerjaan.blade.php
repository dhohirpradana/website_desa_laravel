@extends('layouts.layout')
@section('title', 'Website Resmi Pemerintah Desa '. App\Desa::find(1)->nama_desa . ' - Grafik Pekerjaan')

@section('styles')
<meta name="description" content="Statistik Penduduk Berdasarkan Pekerjaan Desa {{ App\Desa::find(1)->nama_desa }}, Kecamatan {{ App\Desa::find(1)->nama_kecamatan }}, Kabupaten {{ App\Desa::find(1)->nama_kabupaten }}.">
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/accessibility.js"></script>
@endsection

@section('header')
<h1 class="text-white text-sm text-muted">GRAFIK PEKERJAAN</h1>
<h2 class="text-lead text-white">DESA {{ Str::upper(App\Desa::find(1)->nama_desa) }}<br/>KABUPATEN {{ Str::upper(App\Desa::find(1)->nama_kabupaten) }}</h2>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-body">
        <div id="container" style="height: 400px; min-width: 320px; max-width: 600px; margin: 0 auto"></div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    Highcharts.chart('container', {
        chart: {
            type: 'bar',
            marginLeft: 150
        },
        title: {
            text: 'Grafik Pekerjaan'
        },
        subtitle: {
            text: "Total Penduduk: {{ $total }} Jiwa"
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
            data: {!! json_encode($data) !!}
        }]
    });
</script>
@endpush
