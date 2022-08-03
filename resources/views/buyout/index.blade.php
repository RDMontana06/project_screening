@extends('layouts.header')

@section('content')
	<div class="main-panel">
		<div class="content-wrapper">
			<div class="row">
				<div class="col-md-12 grid-margin">
					<div class="row">
						<div class="col-12 col-xl-8 mb-4 mb-xl-0">
							<h3 class="font-weight-bold">Buyout</h3>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header bg-white text-dark mb-3 ">
					<h4 class="font-weight-bold d-flex justify-content-start align-items-center">Buyout Projects
					</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered " id="buyout-tbl">
							<thead>
								<tr>
									<th>Project Name</th>
									<th>Product Type</th>
									<th>Type</th>
									<th>Location</th>
									<th>Approved Budget</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($projects as $projectDetails)
									{{-- @if ($projectDetails->status == 'Pending') --}}
									<tr id='project{{ $projectDetails->id }}'>
										<td>{{ $projectDetails->project_name }}</td>
										<td>{{ $projectDetails->project_type }}</td>
										<td>{{ $projectDetails->type }}</td>
										<td>{{ $projectDetails->location }}</td>
										<td>{{ number_format($projectDetails->approved_budget) }}</td>
										<td id="tdApprovalId{{ $projectDetails->id }}">
											@if ($projectDetails->status == 'Cancelled')
												<label id="approvalStatus{{ $projectDetails->id }}"
													class="badge badge-warning">{{ $projectDetails->status }}</label>
											@elseif ($projectDetails->status == 'Pending')
												<label id="approvalStatus{{ $projectDetails->id }}"
													class="badge badge-info">{{ $projectDetails->status }}</label>
											@elseif ($projectDetails->status == 'Approved')
												<label id="approvalStatus{{ $projectDetails->id }}"
													class="badge badge-success">{{ $projectDetails->status }}</label>
											@elseif ($projectDetails->status == 'For Buyout')
												<label id="approvalStatus{{ $projectDetails->id }}"
													class="badge badge-primary">{{ $projectDetails->status }}</label>
											@else
												<label id="approvalStatus{{ $projectDetails->id }}"
													class="badge badge-warning">{{ $projectDetails->status }}</label>
											@endif

										</td>
										<td style="width:10%;" class="">
											@if(count($projectDetails->bo_companies) != 0)
											<a href="{{ route('buyout_view',[$projectDetails->id])}}" >
												<button type="button" class="btn btn-outline-info btn-rounded btn-icon buyoutSelect" title="Buyout Payment">
													<span class="ti-money"></span>
												</button>
											</a>
											
											@endif
											@if(count($projectDetails->bo_companies) == 0)
												<button type="button" data-toggle="modal" data-id="{{ $projectDetails->id }}" class="btn btn-outline-warning btn-rounded btn-icon buyoutDetails" title="Create Buyout">
													<span  class="ti-pencil-alt"></span>
												</button>
											@endif
											
										</td>
									</tr>
									{{-- @endif --}}
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		@include('buyout.buyout_details')
		@include('layouts.footer')
</div>
@endsection
@section('buyoutScripts')
	<script>
	 $(document).ready(function() {
	  $('#buyout-tbl').DataTable({
	   pageLength: 5,
	   lengthMenu: [
	    [5, 10, 20],
	    [5, 10, 20]
	   ]
	  });
	console.log('XXXX');
	
	 });
	 $(document).ready(function() {
		$(document).on("click", ".buyoutDetails", function () {
			console.log('Tetetstet');
			var id = $(this).data('id');
			$('#buyoutDetails').find('.modal-body #hiddenId').val(id);
			$('#buyoutDetails').modal('show');
		});
	 });
	 
	</script>
@endsection
