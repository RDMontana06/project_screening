<!-- Modal -->
<div class="modal fade" id="buyoutSelect" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @include('errors')
        <form action="savePayment/{{ $buyouts[0]->project_id }}/{{ $buyouts[0]->id }}" method="POST" enctype="multipart/form-data">
         {{csrf_field()}}
          <div class="form-group">
            <label for="total_amt">Total Amount</label>
            <input type="text" class="form-control" disabled="true" value="{{ number_format($buyouts[0]->total_amt) }}" id="total_amt" name="total_amt">
          </div>
          <div class="form-group">
            <label for="total_amt">Total Paid</label>
            <input type="text" class="form-control" disabled="true" value="{{ number_format($buyouts[0]->payments->sum('amount')) }}" id="total_amt" name="total_amt">
          </div>
          <div class="form-group">
            <label for="amount">Amount <small>(Required)</small></label>
            <input type="number" class="form-control" id="amount" name="amount" placeholder="0.00" max="{{ $buyouts[0]->total_amt - $buyouts[0]->payments->sum('amount') }}" min="1" required  value="{{ old('amount') }}">
          </div>
          <div class="form-group">
              <label>Attachments</label>
              <input type="file" name="attachment[]" class="form-control" multiple required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>