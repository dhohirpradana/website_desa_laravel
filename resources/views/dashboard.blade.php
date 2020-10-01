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
            <div class="col-xl-3 col-md-6 mb-3">
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
            <div class="col-xl-3 col-md-6 mb-3">
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
            <div class="col-xl-3 col-md-6 mb-3">
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
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Cetak Surat</h5>
                                <span class="h2 font-weight-bold mb-0">{{ $total }}</span>
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
                    <div class="mb-3">
                        <h2 class="mb-0">Grafik Cetak Surat Harian</h2>
                    </div>
                    <div class="mb-3">
                        <form id="form-tanggal" action="javascript:;" method="GET">
                            <input type="date" name="tanggal" id="tanggal" class="form-control"
                                value="{{ request('tanggal') ? request('tanggal') : date('Y-m-d') }}">
                        </form>
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
                    <div class="mb-3">
                        <h2 class="mb-0">Grafik Cetak Surat Bulanan</h2>
                    </div>
                    <div class="mb-3">
                        <form id="form-bulan" action="javascript:;" method="GET">
                            <input type="month" name="bulan" id="bulan" class="form-control"
                                value="{{ request('bulan') ? request('bulan') : date('Y-m') }}">
                        </form>
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
                    <div class="mb-3">
                        <h2 class="mb-0">Grafik Cetak Surat Tahunan</h2>
                    </div>
                    <div class="mb-3">
                        <form id="form-tahun" action="javascript:;" method="GET">
                            <input type="number" name="tahun" id="tahun" class="form-control"
                                value="{{ request('tahun') ? request('tahun') : date('Y') }}">
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="chart-tahunan" style="height: 400px; margin: 0 auto"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let chart_tahunan = Highcharts.chart('chart-tahunan', {
        chart: {
            type: 'bar',
        },
        title: {
            text: 'Grafik Cetak Surat Tahunan'
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
    });

    let chart_harian = Highcharts.chart('chart-harian', {
        chart: {
            type: 'bar',
        },
        title: {
            text: 'Grafik Cetak Surat Harian'
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
    });

    let chart_bulanan = Highcharts.chart('chart-bulanan', {
        chart: {
            type: 'bar',
        },
        title: {
            text: 'Grafik Cetak Surat Bulanan'
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
    });

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

        $("#form-tanggal").submit(function () {
            let form = this;
            $.get("{{ route('surat-harian') }}", {'tanggal': $(this).find('[name="tanggal"]').val()}, function (response) {
                chart_harian.series[0].setData(response);
            });
        });

        $("#form-bulan").submit(function () {
            let form = this;
            $.get("{{ route('surat-bulanan') }}", {'bulan': $(this).find('[name="bulan"]').val()}, function (response) {
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
