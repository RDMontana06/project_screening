<!-- Modal -->
<div class="modal fade" id="viewDetails{{ $buyoutPayments->bo_companies[0]->id }}" tabindex="-1" role="dialog"
	aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Payment Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-hover table-bordered">
						<tr>
							<th>Payment Date</th>
							<th>Payment Amount</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
						@foreach ($buyoutPayments->bo_companies[0]->payments->sortByDesc('created_at') as $bo_payment)
							<tr>
								<td>{{ date('M-d-Y l', strtotime($bo_payment->created_at)) }}</td>
								<td width="20%" class="text-right">{{ number_format($bo_payment->amount, 2) }}</td>
								<td><label class="badge badge-primary"> {{ $bo_payment->status }}</label></td>
								<td>
									@if ($bo_payment->status != 'Fully Paid')
										<button class="btn btn-icon btn-outline-info btn-sm" data-toggle="modal"
											data-target="#editPayment{{ $bo_payment->bo_company_id }}" title="Edit Payment Amount"><span
												class="fa-solid fa-pen-to-square"></span></button>
										@include('buyoutPayment.edit_payment_modal')
									@endif

								</td>
							</tr>
						@endforeach
						<tfoot>
							<tr>
								<td></td>
								<td class="text-right"><b>Total Amount:</b>
									{{ number_format($buyoutPayments->bo_companies[0]->payments->sum('amount'), 2) }}
								</td>
								<td>
									@if ($buyoutPayments->bo_companies[0]->balance == 0)
										<label class="badge badge-success">Fully Paid</label>
									@endif
								</td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td class="text-right"><b>Running Balance:</b> <span
										class="badge badge-success">{{ number_format($buyoutPayments->bo_companies[0]->total_amt - $buyoutPayments->bo_companies[0]->payments->sum('amount'), 2) }}</span>
								</td>
								<td></td>
								<td></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
