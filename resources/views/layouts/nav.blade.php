<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
	<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
		<a class="navbar-brand brand-logo p-3" href="{{ url('/') }}"><img src="{{ asset('images/PMS-LOGO.svg') }}"
				class="mr-2" alt="logo" /></a>
		<a class="navbar-brand brand-logo-mini" href="{{ url('/') }}"><img src="{{ asset('images/PMS-LOGO-Mini.svg') }}"
				alt="logo" /></a>
	</div>
	<div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
		<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
			<span class="icon-menu"></span>
		</button>
		<ul class="navbar-nav mr-lg-2">
			<li class="nav-item nav-search d-none d-lg-block">
			</li>
		</ul>
		<ul class="navbar-nav navbar-nav-right">
			<li class="nav-item nav-profile dropdown">
				<b> {{ auth()->user()->name }} </b>
			</li>
			<li class="nav-item nav-profile dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
					<img
						src="{{ url('https://www.kindpng.com/picc/m/24-248253_user-profile-default-image-png-clipart-png-download.png') }}"
						alt="profile" />

					<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
						@if (in_array(1, $user->user_roles->pluck('role_id')->toArray()))
							<a class="dropdown-item" href="{{ url('user') }}">
								<i class="ti-user text-primary"></i>
								{{ __('User Management') }}
							</a>
						@endif
						<a class="dropdown-item" href="#" data-toggle="modal" data-target="#change_pass{{ $user->id }}"><i
								class="ti-user text-primary"></i>
							{{ __('Reset Password') }}
						</a>
						<a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
							<i class="ti-power-off text-primary"></i>
							{{ __('Logout') }}
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</div>
			</li>
		</ul>
	</div>
</nav>
@include('user.reset_password')
