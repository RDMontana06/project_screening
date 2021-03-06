<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>PSM System</title>
	<!-- plugins:css -->
	<link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
	<link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
	<link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">

	<link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
	<link rel="stylesheet" href="{{ asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
	<!-- endinject -->
	<!-- Plugin css for this page -->
	<link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
	<link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
	<link rel="stylesheet" href="{{ asset('vendors/sweetalert2/sweetalert2.css') }}" />

	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('js/select.dataTables.min.css') }}"> --}}
	<!-- End plugin css for this page -->
	<!-- inject:css -->
	<link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
	<!-- endinject -->
	<link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
	<style>
		#selectCompany,
		#inputCompany {
			display: none;
		}

	</style>
</head>

<body>
	<div class="container-scroller">
		@include('layouts.nav')
		<div class="container-fluid page-body-wrapper">
			@include('layouts.sidebar')
			@yield('content')
		</div>
	</div>
	<!-- plugins:js -->
	<script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
	<!-- endinject -->
	<!-- Plugin js for this page -->
	<script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
	{{-- <script src="{{ asset('js/dataTables.select.min.js') }}"></script> --}}

	<script src="{{ asset('vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
	<script src="{{ asset('vendors/select2/select2.min.js') }}"></script>

	<script src="{{ asset('js/file-upload.js') }}"></script>
	<script src="{{ asset('js/typeahead.js') }}"></script>
	<script src="{{ asset('js/select2.js') }}"></script>
	<!-- End plugin js for this page -->
	<!-- inject:js -->
	<script src="{{ asset('js/off-canvas.js') }}"></script>
	<script src="{{ asset('js/hoverable-collapse.js') }}"></script>
	<script src="{{ asset('js/template.js') }}"></script>
	<script src="{{ asset('js/settings.js') }}"></script>
	<script src="{{ asset('js/todolist.js') }}"></script>
	<!-- endinject -->
	<!-- Custom js for this page-->
	<script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"
	 integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="{{ asset('js/dashboard.js') }}"></script>

	<script src="{{ asset('js/Chart.roundedBarCharts.js') }}"></script>
	<script src="{{ asset('vendors/datatables.net/jquery.dataTables.js') }}"></script>
	<script src="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
	<script src="{{ asset('js/dataTables.select.min.js') }}"></script>



	<script src="{{ asset('vendors/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
	@include('sweetalert::alert')

	@yield('psScript')
	@yield('paScript')
</body>

</html>
