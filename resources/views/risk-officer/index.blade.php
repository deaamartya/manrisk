@extends('layouts.user.master')

@section('title', 'Default')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/chartist.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row second-chart-list third-news-update">
		<div class="col-lg-6">
			<div class="card">
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<div>Jumlah Sumber Risiko Tahun Ini</div>
						<h4>{{ $counts_risiko }}</h4>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="card">
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<div>Jumlah Risiko Tahun Ini</div>
						<h4>{{ $count_risiko }}</h4>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<h6>TEMUAN HASIL AUDIT TAHUN <span id="tahun-title">{{ date('Y') }}</span></h6>
						<div>
							<select class="form-control" id="tahun-risiko">
								@for($i=0; $i<10; $i++)
									@php $tahun = intval(2022 + $i); @endphp
									<option value="{{ $tahun }}">{{ $tahun }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="small-bar">
						<div class="small-chart flot-chart-container"></div>
					</div>
					<p>Keterangan</p>
					<div>
						<span style="background-color: #f54e49; color:#f54e49; margin-right: 8px; width: 8px; height: 8px;">ab</span>
						<span>Jumlah Risiko</span>	
					</div>
					<div>
						<span style="background-color: #3c88f7; color:#3c88f7; margin-right: 8px; width: 8px; height: 8px;">ab</span>
						<span>Jumlah Mitigasi</span>	
					</div>
					<div>
						<span style="background-color: #51bb25; color:#51bb25; margin-right: 8px; width: 8px; height: 8px;">ab</span>
						<span>Jumlah Mitigasi Selesai</span>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var session_layout = '{{ session()->get('layout') }}';
</script>
@endsection

@section('script')
<script src="{{asset('assets/js/chart/chartist/chartist.js')}}"></script>
<script src="{{asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets/js/dashboard/default.js')}}"></script>
<script src="{{asset('assets/js/notify/index.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		function initBarChart(data) {
			new Chartist.Bar('.small-chart', {
				labels: data.labels,
				series: [
					data.total_risk,
					data.mitigasi,
					data.selesai_mitigasi,
				]
			}, {
				seriesBarDistance: 15,
				axisX: {
					offset: 60
				},
				axisY: {
					offset: 80,
					labelInterpolationFnc: function(value) {
						return value
					},
					scaleMinSpace: 40
				}
			}).on('draw', function (chart) {
				if (chart.type === 'bar') {
					chart.element.attr({
						style: 'width: 20px'
					});
				}
			});
		}
		$('#tahun-risiko').change(function(){
			const url = "{{ url('dashboard/dataRisiko') }}"
			$.post(url, { _token: "{{ csrf_token() }}", tahun: $('#tahun-risiko').val() })
				.done(function(result) {
					$('#tahun-title').html($('#tahun-risiko').val());
					new Chartist.Bar('.small-chart', {
						labels: result.labels,
						series: [
							result.total_risk,
							result.mitigasi,
							result.selesai_mitigasi,
						]
					}, {
						seriesBarDistance: 15,
						axisX: {
							offset: 60
						},
						axisY: {
							offset: 80,
							labelInterpolationFnc: function(value) {
								return value
							},
							scaleMinSpace: 40
						}
					}).on('draw', function (chart) {
						if (chart.type === 'bar') {
							chart.element.attr({
								style: 'width: 20px'
							});
						}
					});
				});
		});
		const date = new Date();
		$('#tahun-risiko').val(date.getUTCFullYear());
		$('#tahun-risiko').change();
	});
</script>
@endsection
