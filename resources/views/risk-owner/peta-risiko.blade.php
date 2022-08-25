@extends('layouts.user.table')
@section('title', 'Sumber Risiko')

@section('custom-css')
<style>
    .highcharts-figure,
    .highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
    }

    .highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
    }

    .highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
    }

    .highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
    padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
    background: #f1f7ff;
    }

    .highcharts-container .scatter-outline-point {
        stroke: rgb(52, 52, 52);
    }
</style>
@endsection

@section('breadcrumb-title')
<h3>Lihat Sumber Risiko</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Sumber Risiko</li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <!-- Zero Configuration  Starts-->
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
            <h5>{{ $company->instansi }}</h5>
        </div>
        <div class="card-body">
          <div>
          <div class="chart-content">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-6" align="center">
                        <div id="basic-scatter"></div>
                        <div id="basic-scatter-loading" class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div>
                    </div>
                    <div class="col-md-6" align="center">
                        <div id="highcharts-donut" style="width: 350px; height: 300px"></div>
                        <div id="highcharts-donut-loading" class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div>
                    </div>
                </div>
            </div>
            </div>
          </div>
          <br>
          <div class="table-responsive">
            <table class="display" id="basic-1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Konteks</th>
                  <th>Sumber Risiko</th>
                  <th>L</th>
                  <th>C</th>
                  <th>R</th>
                </tr>
              </thead>
              <tbody>
                @if($s_risiko != null)
                  @foreach($s_risiko as $s)
                    <tr>
                      <td class="text-center">{{ $loop->iteration }}</td>
                      <td>{{ $s->konteks->konteks }}</td>
                      <td>{{ $s->s_risiko }}</td>
                      <td>{{ number_format($s->l_awal, 2) + 0 }}</td>
                      <td>{{ number_format($s->c_awal, 2) + 0 }}</td>
                      <td>{{ number_format($s->r_awal, 2) + 0 }}</td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('custom-script')
<script src="{{asset('assets/js/chart/chartist/chartist.js')}}"></script>
<script src="{{asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets/js/dashboard/default.js')}}"></script>
<script src="{{asset('assets/js/notify/index.js')}}"></script>
<script src="{{asset('assets/js/counter/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/js/counter/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/js/counter/counter-custom.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
    const low = @json($data_low);
    const med = @json($data_med);
    const high = @json($data_high);
    const extreme = @json($data_extreme);
    const r_tertinggi = @json($r_tertinggi);
    const r_total = @json($r_total);
    const r_all = r_total - r_tertinggi;
    const tahun_req = @json($tahun_req);
    // console.log(low);
    // console.log(med);
    // console.log(high);
    // console.log(extreme);
    // console.log(r_tertinggi);
    console.log(r_all);
    var tahun = 'Tahun ';
    tahun += tahun_req;

    var pieColors = (function () {
        var colors = ['#0066ff', '#ff6600'];

        return colors;
    }());

    // var chart;
    // var options = {
    //     series: [
    //         {
    //             name: "Low",
    //             data: low
    //         },
    //         {
    //             name: "Med",
    //             data: med
    //         },
    //         {
    //             name: "High",
    //             data: high
    //         },
    //         {
    //             name: "Extreme",
    //             data: extreme
    //         }
    //     ],
    //     chart: {
    //         fill: {
    //             colors: ['#F44336', '#E91E63', '#9C27B0']
    //         },
    //         height: 350,
    //         type: 'scatter',
    //         zoom: {
    //             enabled: true,
    //             type: 'xy'
    //         }
    //     },
    //     xaxis: {
    //         min: 0,
    //         max: 5,
    //         tickAmount: 5,
    //         labels: {
    //             formatter: function(val) {
    //                 return parseFloat(val).toFixed(1)
    //             }
    //         },
    //         // labels: ["0.0", "1.0", "2.0", "3.0", "4.0", "5.0"],
    //         // categories: ["0.0", "1.0", "2.0", "3.0", "4.0", "5.0"]
    //     },
    //     yaxis: {
    //         tickAmount: 5,
    //     }
    // };
    // if (chart) chart.destroy();
    // chart = new ApexCharts(
    //     document.querySelector("#basic-scatter"),
    //     options
    // );
    // $("#basic-scatter-loading").hide();
    // $("#basic-scatter").show();
    // chart.render();

    // use highchart
    setTimeout(function(){
        var chart2 = Highcharts.chart('basic-scatter', {
        chart: {
        backgroundColor: {
            linearGradient: [90, 170, 200, 0],
            stops: [
                [0.1, 'rgb(0, 204, 0)'],
                [0.2, 'rgb(255, 255, 0)'],
                [0.7, 'rgb(255, 133, 51)'],
                [0.8, 'rgb(255, 51, 51)'],
            ]
            },
            width: 350,
            height: 300,
            type: 'scatter',
            zoomType: 'xy'
        },
        title: {
            text: 'Grafik Risiko Divisi',
            style:{
            color: '#FFFFFF'
            },
        },
        subtitle: {
            text: tahun,
            style:{
            color: '#FFFFFF'
            },
        },
        xAxis: {
            title: {
                enabled: true,
                text: 'Likelihood (Awal)',
                style:{
                color: '#FFFFFF'
                },
            },

            plotLines: [{
                color: '#d9d9d9',
                width: 1,
                value: 1
            }, {
                color: '#d9d9d9',
                width: 1,
                value: 2
            }, {
                color: '#d9d9d9',
                width: 1,
                value: 3
            }, {
                color: '#d9d9d9',
                width: 1,
                value: 4
            }, {
                color: '#d9d9d9',
                width: 1,
                value: 5
            }],

            lineWidth:1,
            min:0,
            tickInterval: 1,
            max: 5,
        },
        yAxis: {
            title: {
                text: 'Consequence (Awal)',
                style:{
                color: '#FFFFFF'
                },
            },

            lineWidth:1,
            min:0,
            tickInterval: 1,
            max: 5,
            style:{
            color: '#FFFFFF'
            },
    //        alternateGridColor: '#FDFFD5'
        },

        legend: {
            enabled: false
        },
        plotOptions: {
            scatter: {
                marker: {
                    radius: 5,
                    states: {
                        hover: {
                            enabled: false,
                            lineColor: 'rgb(100,100,100)'
                        }
                    }
                },
                states: {
                    hover: {
                        marker: {
                            enabled: false
                        }
                    }
                },
                tooltip: {
                    headerFormat: '',
                    pointFormatter: function() {
                        var string = ''
                        string += `<b>${this.series.points[0].series.options.data[this.index][2]}</b><br>`;
                        string += 'L : ' + this.x + '<br>';
                        string += 'C : ' + this.y + '<br>';
                        string += 'R : ' + this.x*this.y;
                        return string;
                    },
                    shared: true
                }
            }
        },
        //series: data
        series: [{
            color: '#51bb25',
                data: low
            },{
                color: '#f8d62b',
                data: med
            }, {
                color: '#dd8c93',
                data: high
            }, {
                color: '#dc3545',
                data: extreme
                }]
        },function(chart) {
            var pointsGraphics
            for (let index = 0; index < 4; index++) {
                pointsGraphics = chart.series[index].points.map(point => {
                    return point.graphic.element
                })

                pointsGraphics.forEach((elem, i) => {
                        elem.classList.add('scatter-outline-point')
                })
            }
        });
        $('#basic-scatter-loading').hide();
    }, 3000);

    // donut
    Highcharts.chart('highcharts-donut', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: 'Risiko Dengan Nilai R Tertinggi'
        },
        subtitle: {
            text: 'Risiko keterlambatan kedatangan material'
        },
        plotOptions: {
            pie: {
                colors: pieColors,
                innerSize: 100,
                depth: 45
            }
        },
        series: [{
            name: 'Delivered amount',
            data: [
                ['Nilai R', r_tertinggi],
                ['All', r_all]
            ]
        }]
    });
  });
</script>
@endsection
