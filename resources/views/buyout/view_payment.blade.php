<!-- Modal -->
<div class="modal fade" id="viewDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <table class="table table-hover">
                <tr>
                    <th>Payment Date</th>
                    <th>Payment Amount</th>
                    <th>Status</th>
                </tr>
                {{-- {{ dd($buyouts[0]->payments) }} --}}
                @foreach ($buyouts[0]->payments->sortByDesc('created_at') as $bo_payment )
                    <tr>
                        <td>{{ date('M-d-Y l', strtotime($bo_payment->created_at )) }}</td>
                        <td width="20%" class="text-right">{{number_format($bo_payment->amount, 2)}}</td>
                        <td><label class="badge badge-primary"> {{$bo_payment->status}}</label></td>
                    </tr>
                @endforeach
               <tfoot>
                <tr>
                  <td></td>
                  <td class="text-right"><b>Total Amount:</b> {{ number_format($buyouts[0]->payments->sum('amount'), 2) }}
                  </td>
                  <td>
                    @if ($buyouts[0]->total_amt == $buyouts[0]->payments->sum('amount'))
                      <label class="badge badge-success">Fully Paid</label>
                    @endif
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td class="text-right"><b>Running Balance:</b>  <span class="badge badge-success">{{ number_format($buyouts[0]->total_amt - $buyouts[0]->payments->sum('amount'), 2) }}</span></td>
                  <td></td>
                </tr>
               </tfoot>
            </table>
          </div>
      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline-primary">Save changes</button>
      </div> --}}
    </div>
  </div>
</div>