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
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="d-flex justify-content-between mb-3">
						<h6>Status Proses - {{ Auth::user()->perusahaan->instansi }} Tahun <span id="tahun-status-proses-title">{{ date('Y') }}</span></h6>
						<div class="col-lg-3">
							<span class="f-w-500 font-roboto">Tahun : </span>
							<select class="form-control" id="tahun-status-proses">
								@for($i=0; $i<10; $i++)
									@php $tahun = intval(2022 + $i); @endphp
									<option value="{{ $tahun }}">{{ $tahun }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="chart-content">
						<div class="stepwizard">
							<div class="stepwizard-row setup-panel" id="status-proses">
							</div>
							<div id="status-proses-loading" class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row second-chart-list third-news-update">
		<div class="col-xl-6 col-12 pb-0">
			<div class="card o-hidden">
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<h6>Jumlah Risiko Tahun <span id="tahun-jumlah-risiko-title">{{ date('Y') }}</span></h6>
						<div>
							<span class="f-w-500 font-roboto">Tahun : </span>
							<select class="form-control" id="tahun-jumlah-risiko">
								@for($i=0; $i<10; $i++)
									@php $tahun = intval(2022 + $i); @endphp
									<option value="{{ $tahun }}">{{ $tahun }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-12 py-3">
							<div class="ecommerce-widgets media">
								<div class="media-body">
									<p class="f-w-500 font-roboto">Jumlah Sumber Risiko Korporasi</p>
									<h4 class="f-w-500 mb-0 f-26"><span class="counter" id="jml_sumber_risiko">{{ $counts_risiko }}</span></h4>
								</div>
								<div class="ecommerce-box light-bg-primary"><i class="fa fa-pencil-square" aria-hidden="true"></i></div>
							</div>
						</div>
						<div class="col-lg-6 col-12 py-3">
							<div class="ecommerce-widgets media">
								<div class="media-body">
									<p class="f-w-500 font-roboto">Jumlah Risiko Korporasi</span></p>
									<h4 class="f-w-500 mb-0 f-26"><span class="counter" id="jml_risiko_korporasi">{{ $count_risiko }}</span></h4>
								</div>
								<div class="ecommerce-box light-bg-primary"><i class="fa fa-file" aria-hidden="true"></i></div>
							</div>
						</div>
						<div class="col-lg-6 col-12 py-3">
							<div class="ecommerce-widgets media">
								<div class="media-body">
									<p class="f-w-500 font-roboto">Jumlah Risiko Perlu Mitigasi</span></p>
									<h4 class="f-w-500 mb-0 f-26"><span class="counter" id="jml_risiko_mitigasi">{{ $count_mitigasi }}</span></h4>
								</div>
								<div class="ecommerce-box light-bg-primary"><i class="fa fa-filter" aria-hidden="true"></i></div>
							</div>
						</div>
						<div class="col-lg-6 col-12 py-3">
							<div class="media">
								<div class="media-body">
									<p class="f-w-500 font-roboto">Jumlah Risiko Selesai Mitigasi</p>
									<div class="progress-box">
										<h4 class="f-w-500 mb-0 f-26"><span class="counter" id="jml_risiko_selesai_mitigasi">{{ $count_done_mitigasi }}</span></h4>
									</div>
									@if($count_mitigasi > 0)
									<div class="progress sm-progress-bar progress-animate app-right d-flex justify-content-end">
										<div class="progress-gradient-primary" role="progressbar" style="width: 35%" aria-valuenow="{{ intval($count_done_mitigasi / $count_mitigasi * 100) }}" aria-valuemin="0" aria-valuemax="100"><span class="font-primary">{{ intval($count_done_mitigasi / $count_mitigasi * 100) }}%</span><span class="animate-circle"></span></div>
									</div>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-6 col-12 pb-3">
			<div class="card o-hidden h-100 mb-0">
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<h6>Kategori Risiko Tahun <span id="tahun-kat-risiko-title">{{ date('Y') }}</span></h6>
						<div>
							<span class="f-w-500 font-roboto">Tahun : </span>
							<select class="form-control" id="tahun-kat-risiko">
								@for($i=0; $i<10; $i++)
									@php $tahun = intval(2022 + $i); @endphp
									<option value="{{ $tahun }}">{{ $tahun }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="chart-content">
						<div id="basic-pie"></div>
						<div id="basic-pie-loading" class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row second-chart-list third-news-update">
		<div class="col-lg-4">
			<div class="card">
				<div class="card-body">
					<div class="row d-flex justify-content-between mb-3">
						<div class="col-lg-9 col-12">
							<h6>Risiko Korporasi - {{ Auth::user()->perusahaan->instansi }} Tahun <span id="tahun-title">{{ date('Y') }}</span></h6>	
						</div>
						<div class="col-lg-3 col-12">
							<span class="f-w-500 font-roboto">Tahun : </span>
							<select class="form-control" id="tahun-risiko">
								@for($i=0; $i<10; $i++)
									@php $tahun = intval(2022 + $i); @endphp
									<option value="{{ $tahun }}">{{ $tahun }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="chart-content">
						<div id="basic-bar"></div>
						<div id="basic-bar-loading" class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="card">
				<div class="card-body">
					<div class="d-flex justify-content-between mb-3">
						<h6>Peta Risiko Tahun <span id="tahun-title-peta">{{ date('Y') }}</span></h6>
						<div>
							<span class="f-w-500 font-roboto">Tahun : </span>
							<select class="form-control" id="tahun-petarisiko">
								@for($i=0; $i<10; $i++)
									@php $tahun = intval(2022 + $i); @endphp
									<option value="{{ $tahun }}">{{ $tahun }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
						<div class="row">
						@foreach($company as $p)
						<div class="col-xxl-12 col-lg-12">
							<div class="project-box">
								@php
									$count_mitigasi_p = $p->getCountMitigasi();
									$count_done_mitigasi_p = $p->getCountMitigasiDone();
								@endphp
								<div id="badge-progress">
									@if($count_done_mitigasi_p === $count_mitigasi_p)
									<span class="badge badge-green">Done
									@else
									<span class="badge badge-primary">On Progress
									@endif
									</span>
								</div>
								<div class="media">
										<img class="me-1 rounded"
											src="{{ asset('assets/images/logo/logo_company/logo_'.$p->company_code.'.png') }}"
											style="max-height: 30px">
								</div>
								<p>{{ $p->instansi }}</p>
								<div class="row details">
										<div class="col-6"><span>Risiko Rendah</span></div>
										<div class="col-6">
											<div id="risiko-rendah" class="badge badge-green mr-2" style="opacity: 1; position:initial; top:unset; right: unset;">{{ $p->countLow() }}</div>
										</div>
										<div class="col-6"><span>Risiko Sedang</span></div>
										<div class="col-6">
											<div id="risiko-sedang" class="badge badge-warning mr-2" style="opacity: 1; position:initial; top:unset; right: unset;">{{ $p->countMed() }}</div>
										</div>
										<div class="col-6"><span>Risiko Tinggi</span></div>
										<div class="col-6">
											<div id="risiko-tinggi" class="badge badge-pink mr-2" style="opacity: 1; position:initial; top:unset; right: unset;">{{ $p->countHigh() }}</div>
										</div>
										<div class="col-6"><span>Risiko Ekstrem</span></div>
										<div class="col-6">
											<div id="risiko-ekstrem" class="badge badge-danger" style="opacity: 1; position:initial; top:unset; right: unset;">{{ $p->countExtreme() }}</div>
										</div>
										<div class="col-6"> <span>Mitigasi</span></div>
										<div id="mitigasi" class="col-6 text-primary">{{ $p->getCountMitigasi() }}</div>
										<div class="col-6"> <span>Selesai Mitigasi</span></div>
										<div id="selesai-mitigasi"  class="col-6 text-primary">{{ $p->getCountMitigasiDone() }}</div>
								</div>
								<div class="project-status mt-4">
										<div class="media mb-0">
											<p id="mitigasi-percentage" >{{ $p->mitigasiPercentage().'%' }}</p>
											<div class="media-body text-end"><span>Done</span></div>
										</div>
										<div class="progress" style="height: 5px">
											<div id="progress-mitigasi" class="progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width: {{ $p->mitigasiPercentage().'%' }}" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
								</div>
								<div class="row mt-3">
									@if(Auth::user()->is_risk_officer)
										<form method="get" action="{{ route('risk-officer.peta-risiko', $p->company_id) }}">
									@elseif(Auth::user()->is_risk_owner)
										<form method="get" action="{{ route('risk-owner.peta-risiko', $p->company_id) }}">
									@elseif(Auth::user()->is_penilai)
										<form method="get" action="{{ route('penilai.peta-risiko', $p->company_id) }}">
									@endif
										<input type="hidden" id="tahun-risk" name="tahun_risk" value="{{ date('Y') }}">
										<button class="btn btn-success" type="submit" style="width: 100%; margin:auto;">Lihat Peta Risiko</button>
									</form>
									{{--
									@if(Auth::user()->is_risk_officer)
										<a href="{{ route('risk-officer.peta-risiko', $p->company_id) }}" class="btn btn-success">Lihat Peta Risiko</a>
									@elseif(Auth::user()->is_risk_owner)
										<a href="{{ route('risk-owner.peta-risiko', $p->company_id) }}" class="btn btn-success">Lihat Peta Risiko</a>
									@elseif(Auth::user()->is_penilai)
										<a href="{{ route('penilai.peta-risiko', $p->company_id) }}" class="btn btn-success">Lihat Peta Risiko</a>
									@endif
									--}}
								</div>
							</div>
						</div>
						@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="card">
				<div class="card-body">
					<div class="d-flex justify-content-between mb-3">
						<h6>Kompilasi Tingkat Risiko Tahun <span id="tahun-level-risiko-title">{{ date('Y') }}</span></h6>
						<div class="col-lg-3">
							<span class="f-w-500 font-roboto">Tahun : </span>
							<select class="form-control" id="tahun-level-risiko">
								@for($i=0; $i<10; $i++)
									@php $tahun = intval(2022 + $i); @endphp
									<option value="{{ $tahun }}">{{ $tahun }}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="chart-content">
						<div id="basic-stacked-bar"></div>
						<div id="basic-stacked-bar-loading" class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row second-chart-list third-news-update">
		<div class="col-xl-12 risk-col xl-100 box-col-12">
			<div class="card total-users">
				<div class="card-header card-no-border">
					<div class="d-flex justify-content-between mb-3">
						<h6>Biaya Kerugian & Mitigasi Risiko Tahun <span id="tahun-biaya-risiko-title">{{ date('Y') }}</span></h6>
						<div class="col-lg-2">
							<span class="f-w-500 font-roboto">Tahun : </span>
							<select class="form-control" id="tahun-biaya-risiko">
								@for($i=0; $i<10; $i++)
									@php $tahun = intval(2022 + $i); @endphp
									<option value="{{ $tahun }}">{{ $tahun }}</option>
								@endfor
							</select>
						</div>
					</div>
				</div>
				<div class="card-body pt-0">
					<div class="apex-chart-container goal-status text-center row">
						<div class="rate-card col-xl-12">
						<div class="goal-chart">
							<div id="riskfactorchart"></div>
						</div>
						<div class="goal-end-point">
							<ul>
							<li class="mt-3 pt-0">
								<h6 class="font-primary" id="company_name">{{ Auth::user()->perusahaan->instansi }}</h6>
							</li>
							<li>
								<h6 class="mb-2 f-w-400">Total IDR Kuantitatif INDHAN</h6>
								<h5 class="mb-0" id="idr_kuantitatif_indhan">Rp</h5>
							</li>
							</ul>
						</div>
						</div>
						<ul class="col-xl-12">
						<li>
							<div class="goal-detail">
								<h6> <span class="font-primary">Total IDR Kuantitatif : </span><span id="idr_kuantitatif_company">Rp</span></h6>
								<div class="progress sm-progress-bar progress-animate">
									<div class="progress-gradient-primary" role="progressbar" style="width: 100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="goal-detail">
								<h6><span class="font-primary">Total IDR Kuantitatif Residual : </span><span id="idr_kuantitatif_residu">Rp</span></h6>
								<div class="progress sm-progress-bar progress-animate">
									<div class="progress-gradient-primary" role="progressbar" style="width: 100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="goal-detail mb-0">
								<h6><span class="font-primary">Total Biaya Mitigasi : </span><span id="biaya_mitigasi">Rp</span></h6>
								<div class="progress sm-progress-bar progress-animate">
									<div class="progress-gradient-primary" role="progressbar" style="width: 100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
						</li>
						</ul>
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
<script src="{{asset('assets/js/dashboard/default.js')}}"></script>
<script src="{{asset('assets/js/counter/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/js/counter/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/js/counter/counter-custom.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var chart8;
		var chart3;
		var chart9;
		var chart4;
		function initBarChart(data) {
			// console.log('masuk initbarchart');
			var options3 = {
					chart: {
							height: 350,
							type: 'bar',
							toolbar:{
								show: false
							}
					},
					plotOptions: {
							bar: {
									horizontal: false,
									endingShape: 'rounded',
									columnWidth: '55%',
							},
					},
					dataLabels: {
							enabled: true
					},
					stroke: {
							show: true,
							width: 2,
							colors: ['transparent']
					},
					series: [{
							name: 'Total Risiko',
							data: data.total_risk
					}, {
							name: 'Total Risiko Perlu Mitigasi',
							data: data.mitigasi
					}, {
							name: 'Total Risiko Selesai Mitigasi',
							data: data.selesai_mitigasi
					}],
					xaxis: {
							categories: data.labels,
					},
					yaxis: {
							title: {
									text: ''
							}
					},
					fill: {
							opacity: 1

					},
					tooltip: {
						y: {
							formatter: function (val) {
								return val
							}
						}
					},
					colors:[ CubaAdminConfig.primary , CubaAdminConfig.secondary , '#51bb25']
			}

			if (chart3) chart3.destroy();
			chart3 = new ApexCharts(
					document.querySelector("#basic-bar"),
					options3
			);
			$("#basic-bar-loading").hide();
			$("#basic-bar").show();
			chart3.render();
		}
		function initPieChart(data) {
			var options8 = {
				chart: {
						width: 500,
						type: 'pie',
				},
				labels: data.labels,
				series: data.count,
				responsive: [{
						breakpoint: 480,
						options: {
								chart: {
										width: 200
								},
								legend: {
										position: 'bottom'
								}
						}
				}],
				colors:[
					'#f54e49', '#827397', '#8CC0DE', '#3A5BA0',
					'#AEDBCE', '#C499BA', '#FFCD38', '#B4E197',
					'#FFA1A1', '#A0BCC2', '#5F7161', '#92B4EC',
					'#FF8D29', '#FF8B8B', '#94B49F', '#937DC2'
				]
			}
			
			if (chart8) chart8.destroy();

			chart8 = new ApexCharts(
				document.querySelector("#basic-pie"),
				options8
			);
			
			$("#basic-pie-loading").hide();
			$("#basic-pie").show();
			chart8.render();
		}
		function initStackedBarChart(data) {
			var options9 = {
				colors : ['#dc3545', '#dd8c93', '#f8d62b', '#51bb25'],
          series: [
						{
							name: 'Extreme',
							data: [data.countExtreme]
						},
						{
							name: 'High',
							data: [data.countHigh]
						}, {
							name: 'Med',
							data: [data.countMed]
						}, {
							name: 'Low',
							data: [data.countLow]
						},
					],
          chart: {
          type: 'bar',
          height: 350,
          stacked: true,
          zoom: {
            enabled: true
          }
        },
        responsive: [{
          breakpoint: 480,
          options: {
            legend: {
              position: 'bottom',
              offsetX: -10,
              offsetY: 0
            }
          }
        }],
        plotOptions: {
          bar: {
            horizontal: false,
            borderRadius: 10
          },
        },
        xaxis: {
          type: 'category',
          categories: [data.labels],
        },
        legend: {
          position: 'right',
          offsetY: 40
        },
        fill: {
          opacity: 1
        }
			};

			if (chart9) chart9.destroy();
			chart9 = new ApexCharts(
					document.querySelector("#basic-stacked-bar"),
					options9
			);
			$("#basic-stacked-bar-loading").hide();
			$("#basic-stacked-bar").show();
			chart9.render();
		}

		function initBiayaRisikoChart(data) {
			var options4 = {
				series: [data.percent],
				chart: {
					height: 350,
					type: 'radialBar',
					offsetY: -10,
				},

				plotOptions: {
					radialBar: {
						startAngle: -135,
						endAngle: 135,
						inverseOrder: true,
						hollow: {
							margin: 6,
							size: '50%',
							image: '../assets/images/dashboard-2/radial-image.png',
							imageWidth: 140,
							imageHeight: 140,
							imageClipped: false,
						},
						track: {
							opacity: 0.4,
							colors: CubaAdminConfig.primary
						},
						dataLabels: {
							enabled: false,
							enabledOnSeries: undefined,
							formatter: function(val, opts) {
								return val + "%"
							},
							textAnchor: 'middle',
							distributed: false,
							offsetX: 0,
							offsetY: 0,

							style: {
								fontSize: '14px',
								fontFamily: 'Helvetica, Arial, sans-serif',
								fill: ['#2b2b2b'],

							},
						},
					}
				},

				fill: {
					type: 'gradient',
					gradient: {
						shade: 'light',
						shadeIntensity: 0.15,
						inverseColors: false,
						opacityFrom: 1,
						opacityTo: 1,
						stops: [0, 100],
						gradientToColors: ['#a927f9'],
						type: 'horizontal'
					},
				},
				stroke: {
					dashArray: 15,
					strokecolor: ['#ffffff']
				},

				labels: ['Risk loss rate'],
				colors: [CubaAdminConfig.primary],
			};
			

			if (chart4) chart4.destroy();
			chart4 = new ApexCharts(
				document.querySelector("#riskfactorchart"),
				options4
			);

			chart4.render();
		}

		$('#tahun-jumlah-risiko').change(function(){
			const url = "{{ url('dashboard/data-jumlah-risiko') }}"
			$.post(url, { _token: "{{ csrf_token() }}", tahun: $('#tahun-jumlah-risiko').val() })
				.done(function(result) {
					$('#tahun-jumlah-risiko-title').html($('#tahun-jumlah-risiko').val());
					$('#jml_sumber_risiko').html(result.sumber_risiko);
					$('#jml_risiko_korporasi').html(result.risiko_korporasi);
					$('#jml_risiko_mitigasi').html(result.perlu_mitigasi);
					$('#jml_risiko_selesai_mitigasi').html(result.selesai_mitigasi);
			});
		});

		$('#tahun-risiko').change(function(){
			$("#basic-bar").hide();
			$("#basic-bar-loading").show();
			const url = "{{ url('dashboard/data-risiko-korporasi') }}"
			$.post(url, { _token: "{{ csrf_token() }}", tahun: $('#tahun-risiko').val() })
				.done(function(result) {
					$('#tahun-title').html($('#tahun-risiko').val());
					if (result.total_risk.length > 0) {
						initBarChart(result);
					} else {
						$("#basic-bar-loading").hide();
					}
			});
		});

		$('#tahun-petarisiko').change(function(){
			const url = "{{ url('dashboard/data-petarisiko-korporasi') }}";
			// console.log($('#tahun-petarisiko').val());
			$.post(url, { _token: "{{ csrf_token() }}", tahun: $('#tahun-petarisiko').val() })
				.done(function(result) {
					$('#tahun-title-peta').html($('#tahun-petarisiko').val());
					$('#tahun-risk').val($('#tahun-petarisiko').val());
					$('#risiko-rendah').html(result.risiko_rendah);
					$('#risiko-sedang').html(result.risiko_sedang);
					$('#risiko-tinggi').html(result.risiko_tinggi);
					$('#risiko-ekstrem').html(result.risiko_ekstrem);
					$('#mitigasi').html(result.mitigasi);
					$('#selesai-mitigasi').html(result.selesai_mitigasi);
					$('#mitigasi-percentage').html(result.progress_mitigasi);
					$('#progress-mitigasi').attr('aria-valuenow', result.progress_mitigasi).css('width', result.progress_mitigasi+'%');

					if(result.selesai_mitigasi == result.mitigasi){
						$('#badge-progress').html('<span class="badge badge-green">Done</span>');
					}else{
						$('#badge-progress').html('<span class="badge badge-primary">On Progress</span>');
					}
					
			});
		});

		$('#tahun-kat-risiko').change(function(){
			$("#basic-pie").hide();
			$("#basic-pie-loading").show();
			const url = "{{ url('dashboard/data-kategori-risiko') }}"
			$.post(url, { _token: "{{ csrf_token() }}", tahun: $('#tahun-kat-risiko').val() })
				.done(function(result) {
					$('#tahun-kat-risiko-title').html($('#tahun-kat-risiko').val());
					if (result.count.length > 0) {
						initPieChart(result);
					} else {
						$("#basic-pie-loading").hide();
					}
			});
		});

		$('#tahun-level-risiko').change(function(){
			$("#basic-stacked-bar").hide();
			$("#basic-stacked-bar-loading").show();
			const url = "{{ url('dashboard/data-level-risiko') }}"
			$.post(url, { _token: "{{ csrf_token() }}", tahun: $('#tahun-level-risiko').val() })
				.done(function(result) {
					$('#tahun-level-risiko-title').html($('#tahun-level-risiko').val());
					if (result.risk_detail.length > 0) {
						initStackedBarChart(result);
					} else {
						$("#basic-stacked-bar-loading").hide();
					}
			});
		});

		$('#tahun-biaya-risiko').change(function(){
			// console.log("tahun : "+$('#tahun-biaya-risiko').val());
			const url = "{{ url('dashboard/data-biaya-risiko-korporasi') }}"
			$.post(url, { _token: "{{ csrf_token() }}", tahun: $('#tahun-biaya-risiko').val() })
				.done(function(result) {
					// console.log("result : "+result.total_idr_indhan);
					$('#tahun-biaya-risiko-title').html($('#tahun-biaya-risiko').val());
					$('#company_name').html(result.company);
					if(result.total_idr_indhan != null){
						var rupiah_indhan = rupiahFormat(result.total_idr_indhan);
						$('#idr_kuantitatif_indhan').html(rupiah_indhan);
					}else{
						$('#idr_kuantitatif_indhan').html('Rp'+0);
					}

					if(result.total_idr_company != null){
						var rupiah_company = rupiahFormat(result.total_idr_company);
						$('#idr_kuantitatif_company').html(rupiah_company);
					}else{
						$('#idr_kuantitatif_company').html('Rp'+0);
					}

					if(result.total_idr_residu != null){
						var rupiah_residu = rupiahFormat(result.total_idr_residu);
						$('#idr_kuantitatif_residu').html(rupiah_residu);
					}else{
						$('#idr_kuantitatif_residu').html('Rp'+0);
					}

					if(result.total_biaya_mitigasi != null){
						var rupiah_mitigasi = rupiahFormat(result.total_biaya_mitigasi);
						$('#biaya_mitigasi').html(rupiah_mitigasi);
					}else{
						$('#biaya_mitigasi').html('Rp'+0);
					}
					
					initBiayaRisikoChart(result);
			});
		});

		function rupiahFormat(number){
			const format = number.toString().split('').reverse().join('');
			const convert = format.match(/\d{1,3}/g);
			const rupiah = 'Rp' + convert.join('.').split('').reverse().join('') + ',00'
			return rupiah
		}

		$('#tahun-status-proses').change(function() {
			$("#status-proses").hide();
			$("#status-proses-loading").show();
			$('#status-proses').html("");
			const url = "{{ url('dashboard/data-status-proses') }}"
			$.post(url, { _token: "{{ csrf_token() }}", tahun: $('#tahun-status-proses').val() })
				.done(function(result) {
					$('#tahun-status-proses-title').html($('#tahun-status-proses').val());
					for(let i=0; i < result.list.length;i++) {
						let data = result.list[i]
						let code = '<div class="stepwizard-step"><a class="btn '
						if (result.data) {
							if (Number(result.data.id_proses) >= Number(data.id_proses)) {
								code = code + 'btn-green" '; 
							} else {
								code = code + 'btn-gray" ';
							}
						} else {
							code = code + 'btn-gray" ';
						}
						code = code + 'href="#">' + Number(i + 1) + '</a>'
						code = code + '<p>' + data.nama_proses + '</p></div>'
						$('#status-proses').append(code);
						$('#status-proses').show();
					}
					$("#status-proses-loading").hide();
			});
		});

		const date = new Date();
		$('#tahun-risiko').val(date.getUTCFullYear());
		$('#tahun-risiko').change();
		$('#tahun-kat-risiko').val(date.getUTCFullYear());
		$('#tahun-kat-risiko').change();
		$('#tahun-level-risiko').val(date.getUTCFullYear());
		$('#tahun-level-risiko').change();
		$('#tahun-biaya-risiko').val(date.getUTCFullYear());
		$('#tahun-biaya-risiko').change();
		$('#tahun-status-proses').val(date.getUTCFullYear());
		$('#tahun-status-proses').change();
	});
</script>
@endsection
