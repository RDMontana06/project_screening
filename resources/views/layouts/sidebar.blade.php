<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<ul class="nav">
		{{-- <li class="nav-item">
			<a class="nav-link" href="{{ route('index') }}">
				<i class="icon-grid menu-icon"></i>
				<span class="menu-title">Dashboard</span>
			</a>
		</li> --}}
		@if (auth()->user()->roles == 2 || auth()->user()->roles == 1)
			<li class="nav-item">
				<a class="nav-link" href="{{ route('projectScreening') }}">
					<i class="icon-paper menu-icon"></i>
					<span class="menu-title">Project Screening</span>
				</a>
			</li>
		@endif
		@if (auth()->user()->roles == 3 || auth()->user()->roles == 1)
			<li class="nav-item">
				<a class="nav-link" href="{{ route('projectApproval') }}">
					<i class="icon-check menu-icon"></i>
					<span class="menu-title">Project Approvals</span>
				</a>
			</li>
		@endif

	</ul>
</nav>
