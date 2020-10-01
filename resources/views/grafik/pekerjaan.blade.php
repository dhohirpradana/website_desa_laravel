@extends('layouts.app')

@section('title', 'Grafik Pekerjaan')

@section('styles')
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/accessibility.js"></script>
@endsection

@section('content-header')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <h2 class="mb-0">Grafik Pekerjaan</h2>
                        <p class="mb-0 text-sm">Kelola Grafik Pekerjaan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
