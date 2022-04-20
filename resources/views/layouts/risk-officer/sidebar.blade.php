<div class="sidebar-wrapper">
	<div>
		<div class="logo-wrapper">
			<a href="{{route('/')}}"><img class="img-fluid for-light" src="{{asset('assets/images/logo/logo.png')}}" alt=""><img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt=""></a>
			<div class="back-btn"><i class="fa fa-angle-left"></i></div>
			<div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
		</div>
		<div class="logo-icon-wrapper"><a href="{{route('/')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a></div>
		<nav class="sidebar-main">
			<div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
			<div id="sidebar-menu">
				<ul class="sidebar-links" id="simple-bar">
					<li class="back-btn">
						<a href="{{route('/')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a>
						<div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
					</li>
					<li class="sidebar-main-title">
						<div class="welcome-card">
							<div class="logo-circle">
								<img src="{{ asset('assets/images/logo/logo_company/logo2.png') }}" height="48" />
							</div>
							<div class="welcome-text">
								<h6 class="lan-1">Welcome,</h6>
								<p class="lan-2">{{ 'nama divisi' }}</p>
							</div>
						</div>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='risk-officer.sumber-risiko' ? 'active' : '' }}" href="{{route('risk-officer.sumber-risiko.index')}}"> 
							<i data-feather="list"></i>
							<span>Sumber Risiko</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='risk-officer.pengukuran-risiko' ? 'active' : '' }}" href="{{route('risk-officer.pengukuran-risiko')}}">
							<i data-feather="edit-3"></i>
							<span>Pengukuran Risiko</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='risk-officer.pengukuran-risiko-indhan' ? 'active' : '' }}" href="{{route('risk-officer.pengukuran-risiko-indhan')}}">
							<i data-feather="edit"></i>
							<span>Pengukuran Risiko Indhan</span>
						</a>
					</li>
					{{--<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='risk-officer.risiko.index' ? 'active' : '' }}" href="{{route('risk-officer.risiko.index')}}">
							<i data-feather="list"></i>
							<span>View All Risk</span>
						</a>
					</li> --}}
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