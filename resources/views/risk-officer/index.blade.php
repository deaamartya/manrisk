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
		<div class="col-xl-8 xl-100 dashboard-sec box-col-12">
			<div class="card earning-card">
				<div class="card-body p-0">
					<div class="row m-0">
						<div class="col-xl-12 p-0">
							<div class="chart-right">
								<div class="row m-0 p-tb">
									<div class="col-xl-8 col-md-8 col-sm-8 col-12 p-0">
										<div class="inner-top-left">
											<ul class="d-flex list-unstyled">
												<li>Daily</li>
												<li class="active">Weekly</li>
												<li>Monthly</li>
												<li>Yearly</li>
											</ul>
										</div>
									</div>
									<div class="col-xl-4 col-md-4 col-sm-4 col-12 p-0 justify-content-end">
										<div class="inner-top-right">
											<ul class="d-flex list-unstyled justify-content-end">
												<li>Online</li>
												<li>Store</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-12">
										<div class="card-body p-0">
											<div class="current-sale-container">
												<div id="chart-currently"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row border-top m-0">
								<div class="col-xl-4 ps-0 col-md-6 col-sm-6">
									<div class="media p-0">
										<div class="media-left"><i class="icofont icofont-crown"></i></div>
										<div class="media-body">
											<h6>Referral Earning</h6>
											<p>$5,000.20</p>
										</div>
									</div>
								</div>
								<div class="col-xl-4 col-md-6 col-sm-6">
									<div class="media p-0">
										<div class="media-left bg-secondary"><i class="icofont icofont-heart-alt"></i></div>
										<div class="media-body">
											<h6>Cash Balance</h6>
											<p>$2,657.21</p>
										</div>
									</div>
								</div>
								<div class="col-xl-4 col-md-12 pe-0">
									<div class="media p-0">
										<div class="media-left"><i class="icofont icofont-cur-dollar"></i></div>
										<div class="media-body">
											<h6>Sales forcasting</h6>
											<p>$9,478.50     </p>
										</div>
									</div>
								</div>
							</div>
						</div>
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
<script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/stock-prices.js')}}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets/js/dashboard/default.js')}}"></script>
<script src="{{asset('assets/js/notify/index.js')}}"></script>
@endsection
