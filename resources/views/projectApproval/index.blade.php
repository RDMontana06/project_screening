@extends('layouts.header')

@section('content')
	<div class="main-panel">
		<div class="content-wrapper">
			<div class="row">
				<div class="col-md-12 grid-margin">
					<div class="row">
						<div class="col-md-3 mb-4 stretch-card transparent">
							<div class="card card-tale">
								<div class="card-body">
									<p class="mb-4">Approved Projects</p>
									<p class="fs-30 mb-2">{{ $projects->where('status', 'Approved')->count() }}</p>
								</div>
							</div>
						</div>
						<div class="col-md-3 mb-4 stretch-card transparent">
							<div class="card card-dark-blue">
								<div class="card-body">
									<p class="mb-4">Rejected Projects</p>
									<p class="fs-30 mb-2">{{ $projects->where('status', 'Rejected')->count() }}</p>
								</div>
							</div>
						</div>
						<div class="col-md-3 mb-4 stretch-card transparent">
							<div class="card card-light-blue">
								<div class="card-body">
									<p class="mb-4">Pending Approval Projects</p>
									<p class="fs-30 mb-2">{{ $projects->where('status', 'Pending')->count() }}</p>
								</div>
							</div>
						</div>
						<div class="col-md-3 mb-4 stretch-card transparent">
							<div class="card card-light-danger">
								<div class="card-body">
									<p class="mb-4">Total Projects</p>
									<p class="fs-30 mb-2">{{ $projects->count() }}</p>
								</div>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header bg-white text-dark mb-3 ">
							<h4 class="font-weight-bold d-flex justify-content-start align-items-center">Project Approval
							</h4>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped table-hover table-bordered" id="projects-approval">
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
													@elseif ($projectDetails->status == 'Buyout')
														<label id="approvalStatus{{ $projectDetails->id }}"
															class="badge badge-primary">{{ $projectDetails->status }}</label>
													@else
														<label id="approvalStatus{{ $projectDetails->id }}"
															class="badge badge-danger">{{ $projectDetails->status }}</label>
													@endif

												</td>
												<td style="width:10%;" class="">
													@if ($projectDetails->status == 'Pending')
														<button type="button" class="btn btn-icon btn-danger btn-sm cancelBtn"
															data-id="{{ $projectDetails->id }}" id="reject{{ $projectDetails->id }}" title="Reject"
															onclick="rejectProj(this)">
															<i style="margin-left: -1px;" class="ti-close"></i>
														</button>
														<button type="button" class="btn btn-icon btn-success btn-sm approveBtn"
															data-id="{{ $projectDetails->id }}" data-toggle="modal" id="approved{{ $projectDetails->id }}"
															data-target="#approvalModal" title="Approve" onclick="getRow(this)">
															<i style="margin-left: -1px;" class="ti-check"></i>
														</button>
														<button type="button" class="btn btn-icon btn-secondary btn-sm approveBtn"
															data-id="{{ $projectDetails->id }}" id="buyOut{{ $projectDetails->id }}" title="Proceed to Buyout"
															onclick="forBuyOut(this)">
															<i style="margin-left: -3px;" class="ti-arrow-up"></i>
														</button>
													@endif
													<button type="button" data-toggle="modal" data-target="#viewProject{{ $projectDetails->id }}"
														class="btn btn-icon btn-info btn-sm" title="View Project">
														<i style="margin-left: -1px;" class="ti-eye"></i>
													</button>
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
			</div>
		</div>
		@include('layouts.footer')
	</div>
	</div>
	@include('projectApproval.approvalRemarks')
@endsection
@include('projectApproval.paScripts')
