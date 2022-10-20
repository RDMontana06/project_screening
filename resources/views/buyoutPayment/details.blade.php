<!-- Modal -->
<div class="modal fade" id="details{{ $buyoutPayments->bo_companies[0]->id }}" tabindex="-1"
	aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Buyout and Project Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<h4 class="card-title">Buyout Details</h4>
						<div class="table-responsive">
							<table class="table table-striped table-hover">
								<tr>
									<td width="30%" class="font-weight-bold">Company Name</td>
									<td>{{ $buyoutPayments->bo_companies[0]->company_name }}</td>
								</tr>
								<tr>
									<td class="font-weight-bold">Contact Person</td>
									<td>{{ $buyoutPayments->bo_companies[0]->contact_person }}</td>
								</tr>
								<tr>
									<td class="font-weight-bold">Contact Number</td>
									<td>{{ $buyoutPayments->bo_companies[0]->contact_number }}</td>
								</tr>
								<tr>
									<td class="font-weight-bold">Total Amount</td>
									<td>{{ number_format($buyoutPayments->bo_companies[0]->total_amt, 2) }}

									</td>
								</tr>
								<tr>
									<td class="font-weight-bold">Running Balance</td>
									<td>{{ number_format($buyoutPayments->bo_companies[0]->balance, 2) }}
										{{-- @if ($buyouts[0]->payments->sum('amount') > 0)
											<span class="badge badge-success">
												{{ number_format($buyouts[0]->total_amt - $buyouts[0]->payments->sum('amount')) }}
											</span>
										@endif --}}
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="col-md-6">
						<h4 class="card-title">Project Details</h4>
						<div class="table-responsive">

							<table class="table table-striped table-hover">
								<tr>
									<td width="30%" class="font-weight-bold">Project Name</td>
									<td>{{ $buyoutPayments->project_name }}</td>
								</tr>
								<tr>
									<td class="font-weight-bold">Project Type</td>
									<td>{{ $buyoutPayments->project_type }}</td>
								</tr>
								<tr>
									<td class="font-weight-bold">Reference Code</td>
									<td>{{ $buyoutPayments->ref_code }}</td>
								</tr>
								<tr>
									<td class="font-weight-bold">Location</td>
									<td>{{ $buyoutPayments->location }}</td>
								</tr>
								<tr>
									<td class="font-weight-bold">Company Name</td>
									<td>{{ $buyoutPayments->company_name }}</td>
								</tr>
								<tr>
									<td class="font-weight-bold">Type</td>
									<td>{{ $buyoutPayments->type }}</td>
								</tr>
								<tr>
									<td class="font-weight-bold">Approved Budget</td>
									<td>{{ number_format($buyoutPayments->approved_budget, 2) }}</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
			{{-- <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div> --}}
		</div>
	</div>
</div>
