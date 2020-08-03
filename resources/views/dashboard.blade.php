@extends('layouts.app')

@section('title', 'Dashboard')

@section('content-header')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
                            <div class="mb-3">
                                <h2 class="mb-0">Dashboard</h2>
                                <p class="mb-0 text-sm">Kelola Dashboard {{ config('app.name') }}</p>
                            </div>
                            <div class="mb-3">
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
@include('layouts.components.alert')
<div class="card shadow mb-3">
    <div class="card-header">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <div class="mb-3">
                <h2 class="mb-0">Statistik Cetak Surat Harian</h2>
            </div>
            <div class="mb-3">
                <form id="form-tanggal" action="javascript:;" method="GET">
                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ request('tanggal') ? request('tanggal') : date('Y-m-d') }}">
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <canvas id="chart-harian" class="chart-canvas"></canvas>
    </div>
</div>
<div class="card shadow mb-3">
    <div class="card-header font-weight-bold">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <div class="mb-3">
                <h2 class="mb-0">Statistik Cetak Surat Bulanan</h2>
            </div>
            <div class="mb-3">
                <form id="form-bulan" action="javascript:;" method="GET">
                    <input type="month" name="bulan" id="bulan" class="form-control" value="{{ request('bulan') ? request('bulan') : date('Y-m') }}">
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <canvas id="chart-bulanan" class="chart-canvas"></canvas>
    </div>
</div>
<div class="card shadow mb-3">
    <div class="card-header font-weight-bold">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <div class="mb-3">
                <h2 class="mb-0">Statistik Cetak Surat Tahunan</h2>
            </div>
            <div class="mb-3">
                <form id="form-tahun" action="javascript:;" method="GET">
                    <input type="number" name="tahun" id="tahun" class="form-control" value="{{ request('tahun') ? request('tahun') : date('Y') }}">
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <canvas id="chart-tahunan" class="chart-canvas"></canvas>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/plugins/chart.js/dist/Chart.min.js') }}"></script>
<script>
    const chartHarian = document.getElementById('chart-harian').getContext('2d');
    let chart_harian = new Chart(chartHarian, {
        type: "bar",
        data: {
            labels: ['Grafik Cetak Surat Tahunan'],
            datasets: {}
        },
        options: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    fontColor: "#000080",
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                    beginAtZero: true
                    }
                }]
            }
        }
    });

    const chartBulanan = document.getElementById('chart-bulanan').getContext('2d');
    let chart_bulanan = new Chart(chartBulanan, {
        type: "bar",
        data: {
            labels: ['Grafik Cetak Surat Tahunan'],
            datasets: {}
        },
        options: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    fontColor: "#000080",
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                    beginAtZero: true
                    }
                }]
            }
        }
    });

    const chartTahunan = document.getElementById('chart-tahunan').getContext('2d');
    let chart_tahunan = new Chart(chartTahunan, {
        type: "bar",
        data: {
            labels: ['Grafik Cetak Surat Tahunan'],
            datasets: {}
        },
        options: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    fontColor: "#000080",
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                    beginAtZero: true
                    }
                }]
            }
        }
    });

    $(document).ready(function(){
        $(".form-control").change(function () {
            $(this).parent().submit();
        });

        $.get("{{ route('surat-harian') }}", function (response) {
            chart_harian.data.datasets = response;
            chart_harian.update();
        });

        $.get("{{ route('surat-bulanan') }}", function (response) {
            chart_bulanan.data.datasets = response;
            chart_bulanan.update();
        });

        $.get("{{ route('surat-tahunan') }}", function (response) {
            chart_tahunan.data.datasets = response;
            chart_tahunan.update();
        });

        $("#form-tanggal").submit(function () {
            let form = this;
            $.get("{{ route('surat-harian') }}", {'tanggal': $(this).find('[name="tanggal"]').val()}, function (response) {
                chart_harian.data.datasets = response;
                chart_harian.update();
            });
        });

        $("#form-bulan").submit(function () {
            let form = this;
            $.get("{{ route('surat-bulanan') }}", {'bulan': $(this).find('[name="bulan"]').val()}, function (response) {
                chart_bulanan.data.datasets = response;
                chart_bulanan.update();
            });
        });

        $("#form-tahun").submit(function () {
            let form = this;
            $.get("{{ route('surat-tahunan') }}", {'tahun': $(this).find('[name="tahun"]').val()}, function (response) {
                chart_tahunan.data.datasets = response;
                chart_tahunan.update();
            });
        });
    });
</script>
@endpush
