<div class="sidebar-wrapper">
	<div>
		<div class="logo-wrapper">
			<a href="{{ url('/') }}">
				<img class="img-fluid for-light logo-header" src="{{asset('assets/images/logo/logo_company/logo_INHAN.png')}}" alt="">
			</a>
			<div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
		</div>
		<div class="logo-icon-wrapper">
			<a href="{{ url('/') }}">
				<img class="img-fluid" src="{{asset('assets/images/logo/logo_company/logo2.png')}}" alt="">
			</a>
		</div>
		<nav class="sidebar-main">
			<div id="sidebar-menu">
				<ul class="sidebar-links" id="simple-bar">
					<li class="back-btn">
						<a href="{{ url('/') }}"><img class="img-fluid" src="{{asset('assets/images/logo/logo_company/logo2.png')}}" alt=""></a>
						<div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
					</li>
					<li class="sidebar-main-title">
						<div class="welcome-card @if(Auth::user()->company_id === 'LN' || Auth::user()->company_id === 'DI' || Auth::user()->company_id === 'INHAN') flex @endif">
							<div class="logo-circle text-center">
								<img src="{{ asset('assets/images/logo/logo_company/logo_'.Auth::user()->perusahaan->company_code.'.png') }}" height="48" />
							</div>
							<div class="welcome-text">
								<h6 class="lan-1">Welcome,</h6>
								<p class="lan-2">
									{{ Auth::user()->perusahaan->instansi }}
								</p>
							</div>
						</div>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='admin.user' ? 'active' : Route::currentRouteName()=='risk-officer.user' ? 'active' : '' }}" href="{{Auth::user()->is_admin===true ? route('admin.user') : route('risk-officer.user')}}">
							<i data-feather="user"></i>
							<span>User</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='admin.perusahaan' ? 'active' : '' }}" href="{{route('admin.perusahaan')}}">
							<i data-feather="list"></i>
							<span>Perusahaan</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='admin.resiko' ? 'active' : '' }}" href="{{route('admin.resiko')}}">
							<i data-feather="list"></i>
							<span>Resiko</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='admin.konteks' ? 'active' : '' }}" href="{{route('admin.konteks')}}">
							<i data-feather="list"></i>
							<span>Konteks</span>
						</a>
					</li>
                    <hr>
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
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='risk-officer.risiko.index' ? 'active' : '' }}" href="{{route('risk-officer.risiko.index')}}">
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
                    <hr>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='forum' ? 'active' : '' }}" href="{{route('forum')}}">
							<i data-feather="list"></i>
							<span>Forum</span>
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
		</nav>
	</div>
</div>
