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
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='user.sumber-resiko' ? 'active' : '' }}" href="{{route('user.sumber-resiko')}}">
							<i data-feather="list"></i>
							<span>Sumber Resiko</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='user.pengukuran-resiko' ? 'active' : '' }}" href="{{route('user.pengukuran-resiko')}}">
							<i data-feather="edit-3"></i>
							<span>Pengukuran Resiko</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='user.pengukuran-korporasi' ? 'active' : '' }}" href="{{route('user.pengukuran-korporasi')}}">
							<i data-feather="edit"></i>
							<span>Pengukuran Korposari</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='user.resiko' ? 'active' : '' }}" href="{{route('user.resiko')}}">
							<i data-feather="list"></i>
							<span>View All Risk</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='user.mitigasi-plan' ? 'active' : '' }}" href="{{route('user.mitigasi-plan')}}">
							<i data-feather="sidebar"></i>
							<span>Mitigasi Plan</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='user.kuesioner' ? 'active' : '' }}" href="{{route('user.kuesioner')}}">
							<i data-feather="file-text"></i>
							<span>Kuesioner</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='user.table' ? 'active' : '' }}" href="{{route('user.table')}}">
							<i data-feather="list"></i>
							<span>Table</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='user.form' ? 'active' : '' }}" href="{{route('user.form')}}">
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