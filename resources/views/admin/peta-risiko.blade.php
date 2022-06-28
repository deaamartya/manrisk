@extends('layouts.user.table')
@section('title', 'Sumber Risiko')

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
        </div>
        <div class="card-body">
          <div>
          <div class="chart-content">
                <div id="basic-scatter"></div>
                <div id="basic-scatter-loading" class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div>
            </div>
          </div>
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
<script type="text/javascript">
	$(document).ready(function(){
    const low = @json($data_low);
    const med = @json($data_med);
    const high = @json($data_high);
    const extreme = @json($data_extreme);
    console.log(low);
    console.log(med);
    console.log(high);
    console.log(extreme);
    var chart;
    var options = {
        series: [
            {
                name: "Low",
                data: low
            },
            {
                name: "Med",
                data: med
            },
            {
                name: "High",
                data: high
            },
            {
                name: "Extreme",
                data: extreme
            }
        ],
        chart: {
            height: 350,
            type: 'scatter',
            zoom: {
                enabled: true,
                type: 'xy'
            }
        },
        xaxis: {
            tickAmount: 5,
            labels: {
                formatter: function(val) {
                    return parseFloat(val).toFixed(1)
                }
            }
            // labels: ["0.0", "1.0", "2.0", "3.0", "4.0", "5.0"],
            // categories: ["0.0", "1.0", "2.0", "3.0", "4.0", "5.0"]
        },
        yaxis: {
            tickAmount: 5,
        }
    };
    if (chart) chart.destroy();
    chart = new ApexCharts(
        document.querySelector("#basic-scatter"),
        options
    );
    $("#basic-scatter-loading").hide();
    $("#basic-scatter").show();
    chart.render();
  });
</script>
@endsection
