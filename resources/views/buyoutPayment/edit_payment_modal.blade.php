<!-- Modal -->
<div class="modal fade" id="editPayment{{ $bo_payment->bo_company_id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modify Payment Amount</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				@include('errors')
				<form action="updatePaymentAmt/{{ $bo_payment->bo_company_id }}" method="POST" onsubmit="show();">
					{{ csrf_field() }}
					{{-- <div class="form-group">
						<label for="total_amt">Total Amount</label>
						<input type="number" class="form-control" value="{{ $buyoutPayments->bo_companies[0]->total_amt }}"
							id="total_amt_edit" name="total_amt_edit" disabled>
					</div> --}}
					<div class="form-group">
						<label for="amount">Amount</label>
						<input type="number" class="form-control" name="amount_edit" placeholder="0.00" min="1" required
							value="{{ $bo_payment->amount }}"
							oninvalid="this.setCustomValidity('Amount cannot be greater than Total Amount')"
							oninput="this.setCustomValidity('')">
					</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
			</form>
		</div>
	</div>
</div>
