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
					<p><strong>TEMUAN HASIL AUDIT TAHUN {{ date('Y') }}</strong></p>
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
	const labels = @json($labels);
	const total_risk = @json($total_risk);
	const mitigasi = @json($mitigasi);
	const selesai_mitigasi = @json($selesai_mitigasi);
	new Chartist.Bar('.small-chart', {
		labels: labels,
		series: [
			total_risk,
			mitigasi,
			selesai_mitigasi,
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
	}).on('draw', function (data) {
		if (data.type === 'bar') {
			data.element.attr({
				style: 'width: 20px'
			});
		}
	});
</script>
@endsection
