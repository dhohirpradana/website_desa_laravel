$(document).ready(function (){
    $.getJSON(baseURL + '/statistik-penduduk/show', function(response) {
        $(".loading").hide();
        let pie = {
            chart: {
                type: 'pie'
            },
            subtitle: {
                text: "Total Penduduk: " + response.totalPenduduk
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
                    name: "Jumlah",
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
            subtitle: {
                text: "Total Penduduk: " + response.totalPenduduk
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
                name: 'Jumlah',
                data: []
            }]
        };

        let column = {
            chart: {
                type: 'column'
            },
            subtitle: {
                text: 'Total Penduduk : ' + response.totalPenduduk
            },
            xAxis: {
                type: 'category'
            },
            legend: {
                enabled: false
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
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y}'
                    }
                }
            },

            series: [{
                name:"",
                colorByPoint: true,
                data:[]}
            ]
        };

        let chart_agama = Highcharts.chart('chart-agama', pie);
        chart_agama.title.textSetter("Grafik Agama");
        chart_agama.series[0].setData(response.agama);

        let chart_agama_bar = Highcharts.chart('chart-agama-bar', column);
        chart_agama_bar.title.textSetter("Grafik Agama");
        chart_agama_bar.series[0].setData(response.agama);

        let chart_darah = Highcharts.chart('chart-darah', pie);
        chart_darah.title.textSetter("Grafik Golongan Darah");
        chart_darah.series[0].setData(response.darah);

        let chart_darah_bar = Highcharts.chart('chart-darah-bar', column);
        chart_darah_bar.title.textSetter("Grafik Golongan Darah");
        chart_darah_bar.series[0].setData(response.darah);

        let chart_pendidikan = Highcharts.chart('chart-pendidikan', pie);
        chart_pendidikan.title.textSetter("Grafik Pendidikan");
        chart_pendidikan.series[0].setData(response.pendidikan);

        let chart_pendidikan_bar = Highcharts.chart('chart-pendidikan-bar', column);
        chart_pendidikan_bar.title.textSetter("Grafik Pendidikan");
        chart_pendidikan_bar.series[0].setData(response.pendidikan);

        let chart_perkawinan = Highcharts.chart('chart-perkawinan', pie);
        chart_perkawinan.title.textSetter("Grafik Perkawinan");
        chart_perkawinan.series[0].setData(response.perkawinan);

        let chart_perkawinan_bar = Highcharts.chart('chart-perkawinan-bar', column);
        chart_perkawinan_bar.title.textSetter("Grafik Perkawinan");
        chart_perkawinan_bar.series[0].setData(response.perkawinan);

        column.legend = {enabled: true};
        column.xAxis = {categories: [1,2,3],crosshair: true};
        column.series = [{name: "", data:[]},{name: "", data:[]}];
        let chart_usia = Highcharts.chart('chart-usia', column);
        chart_usia.title.textSetter("Grafik Usia");
        chart_usia.xAxis[0].setCategories(response.usia['kategori']);
        chart_usia.series[0].setName('Laki - laki');
        chart_usia.series[0].setData(response.usia['laki']);
        chart_usia.series[1].setName('Perempuan');
        chart_usia.series[1].setData(response.usia['perempuan']);

        let chart_pekerjaan = Highcharts.chart('chart-pekerjaan', bar);
        chart_pekerjaan.title.textSetter("Grafik Pekerjaan");
        chart_pekerjaan.series[0].setData(response.pekerjaan);
        chart_pekerjaan.series[0].setName('Jumlah Penduduk');
    });
});
