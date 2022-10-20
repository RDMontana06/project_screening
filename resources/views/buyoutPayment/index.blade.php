@extends('layouts.header')

@section('content')
	<div class="main-panel">
		<div class="content-wrapper">
			<div class="row">
				<div class="col-md-12 grid-margin">
					<div class="row">
						<div class="col-12 col-xl-8 mb-4 mb-xl-0">
							<h3 class="font-weight-bold">Buyout Payments</h3>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header bg-white text-dark mb-3 ">
					<h4 class="font-weight-bold d-flex justify-content-start align-items-center"> Buyout Projects
					</h4>
				</div>
				@include('errors')
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered " id="buyoutPayment-tbl">
							<thead>
								<tr>
									<th>Project Name</th>
									<th>Product Type</th>
									<th>Approved Budget</th>
									<th>Project Status</th>
									<th>Buyout Company</th>
									<th>Buyout Total Amount</th>
									<th>Buyout Balance Amount</th>
									<th>Buyout Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								{{-- {{ dd($buyoutPayment) }} --}}
								@foreach ($buyoutPayment as $buyoutPayments)
									{{-- @if (buyoutPayments->total_amt == 0.0 || buyoutPayments->total_amt == null) --}}
									<tr id='boPayment{{ $buyoutPayments->id }}'>
										<td class="text-wrap">{{ $buyoutPayments->project_name }}</td>
										<td>{{ $buyoutPayments->project_type }}</td>
										<td>{{ number_format($buyoutPayments->approved_budget) }}</td>
										<td id="tdApprovalId{{ $buyoutPayments->id }}">
											@if ($buyoutPayments->status == 'Cancelled')
												<label id="approvalStatus{{ $buyoutPayments->id }}"
													class="badge badge-warning">{{ $buyoutPayments->status }}</label>
											@elseif ($buyoutPayments->status == 'Pending')
												<label id="approvalStatus{{ $buyoutPayments->id }}"
													class="badge badge-info">{{ $buyoutPayments->status }}</label>
											@elseif ($buyoutPayments->status == 'Approved')
												<label id="approvalStatus{{ $buyoutPayments->id }}"
													class="badge badge-success">{{ $buyoutPayments->status }}</label>
											@elseif ($buyoutPayments->status == 'Buyout')
												<label id="approvalStatus{{ $buyoutPayments->id }}"
													class="badge badge-primary">{{ $buyoutPayments->status }}</label>
											@elseif ($buyoutPayments->status == 'For Payment')
												<label id="approvalStatus{{ $buyoutPayments->id }}"
													class="badge badge-dark">{{ $buyoutPayments->status }}</label>
											@elseif ($buyoutPayments->status == 'Buyout Fully Paid')
												<label id="approvalStatus{{ $buyoutPayments->id }}"
													class="badge badge-outline-success">{{ $buyoutPayments->status }}</label>
											@elseif ($buyoutPayments->status == 'Rejected')
												<label id="approvalStatus{{ $buyoutPayments->id }}"
													class="badge badge-danger">{{ $buyoutPayments->status }}</label>
											@else
												<label id="approvalStatus{{ $buyoutPayments->id }}"
													class="badge badge-light">{{ $buyoutPayments->status }}</label>
											@endif
										</td>
										<td>{{ $buyoutPayments->bo_companies[0]->company_name }}</td>
										<td>{{ number_format($buyoutPayments->bo_companies[0]->total_amt, 2) }}</td>
										<td>{{ number_format($buyoutPayments->bo_companies[0]->balance, 2) }}</td>
										<td>
											@if ($buyoutPayments->bo_companies[0]->balance > 0.0)
												<label class="badge badge-info">{{ $buyoutPayments->bo_companies[0]->status }}</label>
											@endif
											@if ($buyoutPayments->bo_companies[0]->balance == 0)
												<label class="badge badge-success">{{ $buyoutPayments->bo_companies[0]->status }}</label>
											@endif
										</td>
										<td style="width:10%;" class="">
											@if ($buyoutPayments->bo_companies[0]->total_amt == 0)
												<button data-target="#buyoutSelect{{ $buyoutPayments->bo_companies[0]->id }}" data-toggle="modal"
													type="button" class="btn btn-outline-success btn-rounded btn-icon " title="Proceed to Payment">
													<span class="fa-solid fa-money-bill"></span>
												</button>
											@endif
											{{-- {{ dd($buyoutPayments->bo_companies[0]->payments) }} --}}
											@include('buyoutPayment.payment_details')
											@if (count($buyoutPayments->bo_companies[0]->payments))
												<button data-target="#viewDetails{{ $buyoutPayments->bo_companies[0]->id }}" data-toggle="modal"
													class="btn btn-outline-info btn-rounded btn-icon" title="View Payments">
													<span class="fa-solid fa-files"></span>
												</button>
											@endif


											@include('buyoutPayment.details')
											<button data-target="#details{{ $buyoutPayments->bo_companies[0]->id }}" data-toggle="modal"
												class="btn btn-outline-primary btn-rounded btn-icon" title="Details">
												<span class="fa-light fa-file-lines"></span>
											</button>
										</td>

									</tr>
									{{-- @endif --}}
									@include('buyoutPayment.payment_form')
								@endforeach
							</tbody>
						</table>
					</div>
				</div>


			</div>
		</div>
		@include('layouts.footer')
	</div>
@endsection
@section('buyoutScripts')
	<script>
		$(document).ready(function() {
			$('#buyoutPayment-tbl').DataTable({
				pageLength: 5,
				lengthMenu: [
					[5, 10, 20],
					[5, 10, 20]
				]
			});
		});
		// $(document).ready(function() {

		// $(document).on("click", ".buyoutSelect", function() {
		// 	var id = $(this).data('id');
		// 	$('#buyoutSelect').find('.modal-body #hiddenId').val(id);
		// 	// As pointed out in comments, 
		// 	// it is unnecessary to have to manually call the modal.
		// 	$('#buyoutSelect').modal('show');
		// });

		// $(document).on("click", ".viewPayment", function() {
		// var id = $(this).data('id');
		// $('#viewDetails').modal('show');
		// });
	</script>
@endsection
