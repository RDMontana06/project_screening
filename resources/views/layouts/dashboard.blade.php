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
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2 col-half-offset mb-4 stretch-card transparent">
					<div class="card card-inverse-success ">
						<div class="card-body">
							<p class="mb-4">Approved Projects</p>
							<span data-toggle="modal" data-target="#approvedList" style="cursor:pointer;" title="Approved List">
								<p class="fs-30 mb-2">{{ $projects->where('status', 'Approved')->count() }}</p>
							</span>

						</div>
					</div>
				</div>
				<div class="col-md-2 col-half-offset mb-4 stretch-card transparent">
					<div class="card card-inverse-danger">
						<div class="card-body">
							<p class="mb-4">Rejected Projects</p>
							<span data-toggle="modal" data-target="#rejectedList" style="cursor:pointer;" title="Rejected List">
								<p class="fs-30 mb-2">{{ $projects->where('status', 'Rejected')->count() }}</p>
							</span>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-half-offset mb-4 stretch-card transparent">
					<div class="card card-inverse-dark">
						<div class="card-body">
							<p class="mb-4">Pending Approval Projects</p>
							<span data-toggle="modal" data-target="#pendingList" style="cursor:pointer;" title="Pending List">
								<p class="fs-30 mb-2">{{ $projects->where('status', 'Pending')->count() }}</p>
							</span>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-half-offset mb-4 stretch-card transparent">
					<div class="card card-inverse-info">
						<div class="card-body">
							<p class="mb-4">Cancelled Projects</p>
							<span data-toggle="modal" data-target="#cancelledList" style="cursor:pointer;" title="Cancelled List">
								<p class="fs-30 mb-2">{{ $projects->where('status', 'Cancelled')->count() }}</p>
							</span>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-half-offset mb-4 stretch-card transparent">
					<div class="card card-inverse-primary">
						<div class="card-body">
							<p class="mb-4">Buyout Projects</p>
							<span data-toggle="modal" data-target="#buyoutList" style="cursor:pointer;" title="Buyout List">
								<p class="fs-30 mb-2">{{ $projects->where('status', 'Buyout')->count() }}</p>
							</span>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-half-offset mb-4 stretch-card transparent">
					<div class="card card-inverse-warning">
						<div class="card-body">
							<p class="mb-4">Under Development</p>
							{{-- <p class="fs-30 mb-2">{{ $projects->where('status', 'Cancelled')->count() }}</p> --}}
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<p class="card-title mb-0">Top Projects</p>
							<div class="table-responsive">
								<table class="table table-striped table-borderless">
									<thead>
										<tr>
											<th>Project</th>
											<th>Approved Budget</th>
											<th>Buyout Amount</th>
											<th>Date Created</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($buyouts as $buyout)
											@if ($buyout->count() > 0)
												<tr>
													<td class="text-wrap">{{ $buyout->project->project_name }}</td>
													<td>{{ number_format($buyout->project->approved_budget, 2) }}</td>
													<td>{{ number_format($buyout->total_amt, 2) }}</td>
													<td>{{ Date('F-d-Y', strtotime($buyout->created_at)) }}</td>
												</tr>
											@endif
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<p class="card-title mb-0">Top Buyout Payments</p>
							<div class="table-responsive">
								<table class="table table-striped table-borderless">
									<thead>
										<tr>
											<th>Buyout Company</th>
											<th>Amount Paid</th>
											<th>Total Buyout</th>
											<th>Balance</th>
											<th>Last Payment Date</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($buyouts as $buyout)
											@if ($buyout->count() > 0)
												<tr>
													<td>{{ $buyout->company_name }}</td>
													<td>{{ number_format($buyout->payments->sum('amount'), 2) }}</td>
													<td>{{ number_format($buyout->total_amt, 2) }}</td>
													<td>{{ number_format($buyout->balance, 2) }}</td>
													<td>
														@if ($buyout->payments->first())
															{{ Date('F-d-Y', strtotime($buyout->payments->first()->created_at)) }}
														@endif
													</td>
												</tr>
											@endif
										@endforeach
									</tbody>
								</table>
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
	{{-- Modals --}}
	@include('layouts.approved')
	@include('layouts.rejected')
	@include('layouts.pending')
	@include('layouts.buyout')
	@include('layouts.cancelled')
	</div>
@endsection
@section('dashboardScript')
	<script>
		$(document).ready(function() {
			$('#approved-table').DataTable({
				pageLength: 5,
				lengthMenu: [
					[5, 10, 20],
					[5, 10, 20]
				]
			});
			$('#rejected-table').DataTable({
				pageLength: 5,
				lengthMenu: [
					[5, 10, 20],
					[5, 10, 20]
				]
			});
			$('#pending-table').DataTable({
				pageLength: 5,
				lengthMenu: [
					[5, 10, 20],
					[5, 10, 20]
				]
			});
			$('#cancelled-table').DataTable({
				pageLength: 5,
				lengthMenu: [
					[5, 10, 20],
					[5, 10, 20]
				]
			});
			$('#buyout-table').DataTable({
				pageLength: 5,
				lengthMenu: [
					[5, 10, 20],
					[5, 10, 20]
				]
			});
		});
		n = new Date();
		y = n.getFullYear();
		m = n.getMonth() + 1;
		d = n.getDate();
		document.getElementById("date").innerHTML = m + "/" + d + "/" + y;
	</script>
@endsection
