@extends('layouts.layout')
@section('title', 'Website Resmi Pemerintah Desa '. App\Desa::find(1)->nama_desa . ' - Grafik Golongan Darah')

@section('styles')
<meta name="description" content="Statistik Penduduk Berdasarkan Golongan Darah Desa {{ App\Desa::find(1)->nama_desa }}, Kecamatan {{ App\Desa::find(1)->nama_kecamatan }}, Kabupaten {{ App\Desa::find(1)->nama_kabupaten }}.">
<script src="https://code.highcharts.com/highcharts.js"></script>
@endsection

@section('header')
<h1 class="text-white text-sm text-muted">GRAFIK GOLONGAN DARAH</h1>
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
            type: 'pie'
        },
        title: {
            text: 'Grafik Golongan Darah'
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.y:f} Jiwa'
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
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:f}</b> Jiwa<br/>'
        },

        series: [
            {
                name: "Golongan Darah",
                colorByPoint: true,
                shadow:1,
                border:1,
                data: {!! json_encode($data) !!}
            }
        ]
    });
</script>
@endpush
