@extends('layouts.header')

@section('content')
	<div class="main-panel">
		<div class="content-wrapper">
			<div class="row">
				<div class="col-md-12 grid-margin">
					<div class="row">
						<div class="col-12 col-xl-8 mb-4 mb-xl-0">
							<h3 class="font-weight-bold">Welcome {{ Auth::user()->name }}</h3>
							<h6 class="font-weight-normal mb-0">All systems are running smoothly! Current Date <span class="text-primary"
									id="date"></span></h6>
						</div>
						{{-- <div class="col-12 col-xl-4">
                 <div class="justify-content-end d-flex">
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                     <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                      <a class="dropdown-item" href="#">January - March</a>
                      <a class="dropdown-item" href="#">March - June</a>
                      <a class="dropdown-item" href="#">June - August</a>
                      <a class="dropdown-item" href="#">August - November</a>
                    </div>
                  </div>
                 </div>
                </div> --}}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 grid-margin stretch-card">
					<div class="card tale-bg">
						<div class="card-people mt-auto">
							<img src="images/dashboard/people.svg" alt="people">
							<div class="weather-info">
								<div class="d-flex">
									<div>
										<h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>
									</div>
									<div class="ml-2">
										<h4 class="location font-weight-normal">Metro Manila</h4>
										<h6 class="font-weight-normal">Philippines</h6>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 grid-margin transparent">
					<div class="row">
						<div class="col-md-6 mb-4 stretch-card transparent">
							<div class="card card-tale">
								<div class="card-body">
									<p class="mb-4">Approved Projects</p>
									<p class="fs-30 mb-2">4006</p>
									<p>10.00% (30 days)</p>
								</div>
							</div>
						</div>
						<div class="col-md-6 mb-4 stretch-card transparent">
							<div class="card card-dark-blue">
								<div class="card-body">
									<p class="mb-4">Decline Projects</p>
									<p class="fs-30 mb-2">61344</p>
									<p>22.00% (30 days)</p>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
							<div class="card card-light-blue">
								<div class="card-body">
									<p class="mb-4">Pending Approval Projects</p>
									<p class="fs-30 mb-2">34040</p>
									<p>2.00% (30 days)</p>
								</div>
							</div>
						</div>
						<div class="col-md-6 stretch-card transparent">
							<div class="card card-light-danger">
								<div class="card-body">
									<p class="mb-4">Total Projects</p>
									<p class="fs-30 mb-2">47033</p>
									<p>0.22% (30 days)</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>




		</div>
		<!-- content-wrapper ends -->
		<!-- partial:partials/_footer.html -->
		@include('layouts.footer')
		<!-- partial -->
	</div>
	<!-- main-panel ends -->
	</div>
	<script>
	 n = new Date();
	 y = n.getFullYear();
	 m = n.getMonth() + 1;
	 d = n.getDate();
	 document.getElementById("date").innerHTML = m + "/" + d + "/" + y;
	</script>
@endsection
