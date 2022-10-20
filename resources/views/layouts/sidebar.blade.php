<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<ul class="nav">
		@if (in_array(1, $user->user_roles->pluck('role_id')->toArray()) ||
		    in_array(3, $user->user_roles->pluck('role_id')->toArray()) ||
		    in_array(4, $user->user_roles->pluck('role_id')->toArray()))
			<li class="nav-item {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
				<a class="nav-link " href="{{ url('/home') }}">
					<i class="icon-grid menu-icon"></i>
					<span class="menu-title">Dashboard</span>
				</a>
			</li>
			<li class="nav-item {{ Route::currentRouteName() == 'projectScreening' ? 'active' : '' }}">
				<a class="nav-link " href="{{ route('projectScreening') }}">
					<i class="icon-paper menu-icon"></i>
					<span class="menu-title">Project Screening</span>
				</a>
			</li>
		@endif
		@if (in_array(1, $user->user_roles->pluck('role_id')->toArray()) ||
		    in_array(3, $user->user_roles->pluck('role_id')->toArray()))
			<li class="nav-item {{ Route::currentRouteName() == 'projectApproval' ? 'active' : '' }}">
				<a class="nav-link" href="{{ route('projectApproval') }}">
					<i class="icon-check menu-icon"></i>
					<span class="menu-title">Project Approvals</span>
				</a>
			</li>
		@endif
		@if (in_array(1, $user->user_roles->pluck('role_id')->toArray()) ||
		    in_array(3, $user->user_roles->pluck('role_id')->toArray()) ||
		    in_array(4, $user->user_roles->pluck('role_id')->toArray()))
			<li class="nav-item  @if (Route::currentRouteName() == 'buyout' || Route::currentRouteName() == 'buyout_view') active @endif">
				<a class="nav-link" href="{{ route('buyout') }}">
					<i class="ti-money menu-icon"></i>
					<span class="menu-title">Buyout</span>
				</a>
			</li>
		@endif
		@if (in_array(1, $user->user_roles->pluck('role_id')->toArray()) ||
		    in_array(4, $user->user_roles->pluck('role_id')->toArray()))
			<li class="nav-item  @if (Route::currentRouteName() == 'buyout_payment') active @endif">
				<a class="nav-link" href="{{ route('buyout_payment') }}">
					<i class="ti-briefcase menu-icon"></i>
					<span class="menu-title">Buyout Payments</span>
				</a>
			</li>
		@endif
		{{-- <li class="nav-item">
			<a class="nav-link" href="{{ route('user') }}">
				<i class="icon-paper menu-icon"></i>
				<span class="menu-title">User Management</span>
			</a>
		</li> --}}
	</ul>
</nav>
