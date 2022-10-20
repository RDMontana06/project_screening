<!-- Modal -->
<div class="modal fade" id="buyoutSelect{{ $buyoutPayments->bo_companies[0]->id }}" tabindex="-1" role="dialog"
	aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Payment {{ $buyoutPayments->bo_companies[0]->id }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form
				action="savePayment/{{ $buyoutPayments->bo_companies[0]->project_id }}/{{ $buyoutPayments->bo_companies[0]->id }}"
				method="POST" onSubmit="disableBtn()" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="modal-body">

					<div class="form-group">
						<label for="total_amt">Total Amount</label>
						@if ($buyoutPayments->bo_companies[0]->total_amt > 0)
							<input type="number" class="form-control" value="{{ $buyoutPayments->bo_companies[0]->total_amt }}"
								id="total_amt" name="total_amt" required readonly>
						@else
							<input type="number" class="form-control" value="" id="totalAmt" name="total_amt" required>
						@endif

					</div>
					<div class="form-group">
						<label for="total_amt">Total Paid</label>
						<input type="text" class="form-control" disabled="true"
							value="{{ number_format($buyoutPayments->bo_companies[0]->payments->sum('amount')) }}" id="total_paid"
							name="total_amt_paid">
					</div>
					<div class="form-group">
						<label for="amount">Amount <small>(Required)</small></label>
						<input type="number" class="form-control" id="amt" name="amount" placeholder="0.00" min="1"
							required value="{{ old('amount') }}">
					</div>
					<div class="form-group">
						<label>Attachments</label>
						<input type="file" name="attachment[]" class="form-control" multiple required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-outline-primary" id="savePay">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	function disableBtn() {
		console.log('------------');
		document.querySelector('#savePay').disabled = true;
	}

	function checkAmt() {
		let tot = document.querySelector('#totalAmt').value;
		let amt = document.querySelector('#amt').value;
		if (amt > tot) {
			alert('Invalid Amount');
		}
	}
</script>
