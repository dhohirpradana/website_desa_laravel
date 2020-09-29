@extends('layouts.app')

@section('title', 'Grafik Pekerjaan')

@section('styles')
<script src="https://code.highcharts.com/highcharts.js"></script>
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
            text: 'Grafik Pekerjaan'
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.y:f} Jiwa'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:f}</b> Jiwa<br/>'
        },

        series: [
            {
                name: "Pekerjaan",
                colorByPoint: true,
                data: {!! json_encode($data) !!}
            }
        ]
    });
</script>
@endpush
