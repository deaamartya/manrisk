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
					@if (Auth::user()->is_risk_officer || Auth::user()->is_admin)
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav
						{{ Route::currentRouteName() == 'admin.user' ? 'active' : Route::currentRouteName() == 'risk-officer.user' ? 'active' : '' }}" href="{{ Auth::user()->is_admin ? route('admin.user') : route('risk-officer.user') }}">
							<i data-feather="user"></i>
							<span>User</span>
						</a>
					</li>
                    @endif
					@if(Auth::user()->is_admin)
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='admin.perusahaan' ? 'active' : '' }}" href="{{route('admin.perusahaan')}}">
							<i data-feather="list"></i>
							<span>Perusahaan</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='admin.risiko' ? 'active' : '' }}" href="{{route('admin.risiko')}}">
							<i data-feather="list"></i>
							<span>Risiko</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='admin.konteks' ? 'active' : '' }}" href="{{route('admin.konteks')}}">
							<i data-feather="list"></i>
							<span>Konteks</span>
						</a>
					</li>
					<hr>
					@endif
					@if(Auth::user()->is_risk_officer == 1 || Auth::user()->is_admin == 1)
					<li class="sidebar-list">
						@if(Auth::user()->is_risk_officer == 1)
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='risk-officer.sumber-risiko' ? 'active' : '' }}" href="{{route('risk-officer.sumber-risiko.index')}}">
							<i data-feather="list"></i>
							<span>Sumber Risiko</span>
						</a>
						@elseif(Auth::user()->is_admin == 1)
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='admin.sumber-risiko-indhan' ? 'active' : '' }}" href="{{route('admin.sumber-risiko-indhan')}}">
							<i data-feather="list"></i>
							<span>Sumber Risiko</span>
						</a>
						@endif
					</li>
					@endif
					<li class="sidebar-list">
						@if(Auth::user()->is_risk_officer == 1)
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='risk-officer.pengukuran-risiko' ? 'active' : '' }}" href="{{route('risk-officer.pengukuran-risiko')}}">
							<i data-feather="edit-3"></i>
							<span>Pengukuran Risiko</span>
						</a>
						@elseif(Auth::user()->is_risk_owner == 1)
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='risk-owner.pengukuran-risiko' ? 'active' : '' }}" href="{{route('risk-owner.pengukuran-risiko')}}">
							<i data-feather="edit-3"></i>
							<span>Pengukuran Risiko</span>
						</a>
						@elseif(Auth::user()->is_penilai == 1)
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='penilai.pengukuran-risiko' ? 'active' : '' }}" href="{{route('penilai.pengukuran-risiko')}}">
							<i data-feather="edit-3"></i>
							<span>Pengukuran Risiko</span>
						</a>
						@endif
					</li>
					@if(Auth::user()->is_penilai_indhan == 1)
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='penilai-indhan.pengukuran-risiko-indhan' ? 'active' : '' }}" href="{{route('penilai-indhan.pengukuran-risiko-indhan')}}">
							<i data-feather="edit"></i>
							<span>Pengukuran Risiko Indhan</span>
						</a>
					</li>
					@endif
					@if(Auth::user()->is_risk_officer == 1)
					<li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='risk-officer.risiko.index' ? 'active' : '' }}" href="{{route('risk-officer.risiko.index')}}">
							<i data-feather="list"></i>
							<span>Risk Register Korporasi</span>
						</a>
					</li>
                    @endif
                    @if(Auth::user()->is_risk_officer == 1 || Auth::user()->is_admin == 1)
                    @if(Auth::user()->is_admin == 1)
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='admin.hasil-kompilasi-risiko' ? 'active' : '' }}" href="{{route('admin.hasil-kompilasi-risiko')}}">
                            <i data-feather="file"></i>
                            <span>Hasil Kompilasi Risiko</span>
                        </a>
                    </li>
                    @endif
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav
                        {{ Route::currentRouteName() == 'admin.approval-hasil-mitigasi.index' ? 'active' : Route::currentRouteName() == 'risk-officer.mitigasi-plan.index' ? 'active' : '' }}" href="{{ Auth::user()->is_admin ? route('admin.approval-hasil-mitigasi.index') : route('risk-officer.mitigasi-plan.index') }}">
							<i data-feather="sidebar"></i>
							<span>Mitigasi Plan</span>
						</a>
					</li>
                    @endif
					@if(Auth::user()->is_admin)
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav d-flex {{ Route::currentRouteName()=='admin.mitigasi-plan.index' ? 'active' : '' }}" href="{{route('admin.mitigasi-plan.index')}}">
							<i data-feather="file-text"></i>
							<div class="flex-row-between-center">
								<span class="me-4p">Pengajuan Mitigasi</span>
								@if ($counts > 0)
									<span class="badge rounded-pill badge-danger">{{ $counts }}</span>
								@endif
							</div>
						</a>
					</li>
					@endif
					@if(Auth::user()->is_admin)
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='admin.risk-register-korporasi' ? 'active' : '' }}" href="{{route('admin.risk-register-korporasi')}}">
							<i data-feather="sidebar"></i>
							<span>Risk Register Korporasi</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='admin.risk-register-indhan' ? 'active' : '' }}" href="{{route('admin.risk-register-indhan.index')}}">
							<i data-feather="sidebar"></i>
							<span>Risk Register INDHAN</span>
						</a>
					</li>
					@endif
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='forum' ? 'active' : '' }}" href="{{route('forum')}}">
							<i data-feather="list"></i>
							<span>Forum</span>
						</a>
					</li>
					@if(Auth::user()->is_risk_owner)
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName()=='risk-owner.risiko.index' ? 'active' : '' }}" href="{{route('risk-owner.risiko.index')}}">
							<i data-feather="list"></i>
							<span>Risk Register Korporasi</span>
						</a>
					</li>
					@endif
				</ul>
			</div>
		</nav>
	</div>
</div>
