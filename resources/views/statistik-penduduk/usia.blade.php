@extends('layouts.layout')
@section('title', 'Website Resmi Pemerintah Desa '. App\Desa::find(1)->nama_desa . ' - Grafik Usia')

@section('styles')
<meta name="description" content="Statistik Penduduk Berdasarkan Usia Desa {{ App\Desa::find(1)->nama_desa }}, Kecamatan {{ App\Desa::find(1)->nama_kecamatan }}, Kabupaten {{ App\Desa::find(1)->nama_kabupaten }}.">
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/accessibility.js"></script>
@endsection

@section('header')
<h1 class="text-white text-sm text-muted">GRAFIK USIA</h1>
<h2 class="text-lead text-white">DESA {{ Str::upper(App\Desa::find(1)->nama_desa) }}<br/>KABUPATEN {{ Str::upper(App\Desa::find(1)->nama_kabupaten) }}</h2>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-body">
        <div id="container"></div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Usia'
        },
        subtitle: {
            text: "Total Penduduk: {{ $total }} Jiwa"
        },
        xAxis: {
            categories: {!! json_encode($kategori) !!},
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
            name: 'Jumlah Penduduk',
            data: {!! json_encode($data) !!}
        }]
    });
</script>
@endpush
