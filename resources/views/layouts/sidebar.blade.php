<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<ul class="nav">
		<li class="nav-item {{ (Route::currentRouteName() == 'home') ? 'active' : '' }}">
			<a class="nav-link " href="{{ url('/home') }}">
				<i class="icon-grid menu-icon"></i>
				<span class="menu-title">Dashboard</span>
			</a>
		</li>
		<li class="nav-item {{ (Route::currentRouteName() == 'projectScreening') ? 'active' : '' }}">
			<a class="nav-link " href="{{ route('projectScreening') }}">
				<i class="icon-paper menu-icon"></i>
				<span class="menu-title">Project Screening</span>
			</a>
		</li>
		<li class="nav-item {{ (Route::currentRouteName() == 'projectApproval') ? 'active' : '' }}">
			<a class="nav-link" href="{{ route('projectApproval') }}">
				<i class="icon-check menu-icon"></i>
				<span class="menu-title">Project Approvals</span>
			</a>
		</li>
		<li class="nav-item  @if(Route::currentRouteName() == 'buyout' || Route::currentRouteName() == 'buyout_view') active @endif">
			<a class="nav-link" href="{{ route('buyout') }}">
				<i class="ti-money menu-icon"></i>
				<span class="menu-title">Buyout</span>
			</a>
		</li>
		{{-- <li class="nav-item">
			<a class="nav-link" href="{{ route('user') }}">
				<i class="icon-paper menu-icon"></i>
				<span class="menu-title">User Management</span>
			</a>
		</li> --}}
	</ul>
</nav>
