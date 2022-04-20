<div class="sidebar-wrapper">
	<div>
		<div class="logo-wrapper">
			<a href="{{ url('/') }}"><img class="img-fluid for-light" src="{{asset('assets/images/logo/logo_company/logo1.png')}}" alt=""><img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt=""></a>
			<div class="back-btn"><i class="fa fa-angle-left"></i></div>
			<div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
		</div>
		<div class="logo-icon-wrapper">
			<a href="{{ url('/') }}">
				<img class="img-fluid" src="{{asset('assets/images/logo/logo_company/logo2.png')}}" alt="">
			</a>
		</div>
		<nav class="sidebar-main">
			<div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
			<div id="sidebar-menu">
				<ul class="sidebar-links" id="simple-bar">
					<li class="back-btn">
						<a href="{{ url('/') }}"><img class="img-fluid" src="{{asset('assets/images/logo/logo_company/logo2.png')}}" alt=""></a>
						<div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
					</li>
					<li class="sidebar-main-title">
						<div class="welcome-card @if(Auth::user()->company_id === 'LN' || Auth::user()->company_id === 'DI' || Auth::user()->company_id === 'INHAN') flex @endif">
							<div class="logo-circle text-center">
								@if(Auth::user()->company_id === 'PI')
									<img src="{{ asset('assets/images/logo/logo_company/logo_pal.png') }}" height="48" />
								@elseif(Auth::user()->company_id === 'LN')
									<img src="{{ asset('assets/images/logo/logo_company/logo_len.png') }}" height="48" />
								@elseif(Auth::user()->company_id === 'DI')
									<img src="{{ asset('assets/images/logo/logo_company/logo_dirgantara.png') }}" height="48" />
								@elseif(Auth::user()->company_id === 'DH')
									<img src="{{ asset('assets/images/logo/logo_company/logo_dahana.png') }}" height="48" />
								@elseif(Auth::user()->company_id === 'PD')
									<img src="{{ asset('assets/images/logo/logo_company/logo_pindad.png') }}" height="48" />
								@elseif(Auth::user()->company_id === 'INHAN')
									<img src="{{ asset('assets/images/logo/logo_company/logo2.png') }}" height="48" />
								@endif
							</div>
							<div class="welcome-text">
								<h6 class="lan-1">Welcome,</h6>
								<p class="lan-2">
									@php
										$kat = Auth::user()->kat_user;
										switch($kat) {
											case 1:
												echo 'Risk Officer ';
												break;
											case 2:
												echo 'Risk Owner ';
												break;
											case 3:
												echo 'Admin ';
												break;
										}
									@endphp
									{{ Auth::user()->instansi }}
								</p>
							</div>
						</div>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='risk-officer.sumber-resiko' ? 'active' : '' }}" href="{{route('risk-officer.sumber-resiko')}}">
							<i data-feather="list"></i>
							<span>Sumber Resiko</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='risk-officer.pengukuran-resiko' ? 'active' : '' }}" href="{{route('risk-officer.pengukuran-resiko')}}">
							<i data-feather="edit-3"></i>
							<span>Pengukuran Resiko</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='risk-officer.pengukuran-korporasi' ? 'active' : '' }}" href="{{route('risk-officer.pengukuran-korporasi')}}">
							<i data-feather="edit"></i>
							<span>Pengukuran Korposari</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='risk-officer.resiko' ? 'active' : '' }}" href="{{route('risk-officer.resiko')}}">
							<i data-feather="list"></i>
							<span>View All Risk</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='risk-officer.mitigasi-plan' ? 'active' : '' }}" href="{{route('risk-officer.mitigasi-plan')}}">
							<i data-feather="sidebar"></i>
							<span>Mitigasi Plan</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='risk-officer.kuesioner' ? 'active' : '' }}" href="{{route('risk-officer.kuesioner')}}">
							<i data-feather="file-text"></i>
							<span>Kuesioner</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='risk-officer.table' ? 'active' : '' }}" href="{{route('risk-officer.table')}}">
							<i data-feather="list"></i>
							<span>Table</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='risk-officer.form' ? 'active' : '' }}" href="{{route('risk-officer.form')}}">
							<i data-feather="file-text"></i>
							<span>Form</span>
						</a>
					</li>
				</ul>
			</div>
			<div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
		</nav>
	</div>
</div>