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
                @if ($buyouts[0]->total_amt - $buyouts[0]->payments->sum('amount') > 0)
                    <button type="button" data-toggle="modal" data-id="{{ $buyouts[0]->id }}"
                        class="btn btn-outline-success buyoutSelect">Add Payment
                    </button>
                @endif
					<button class="btn btn-outline-info viewPayment" >View Payments</button>
				</div>
                <div class="card-body">
                
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title">Buyout Details</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <tr>
                                    <td width="30%">Company Name:</td>
                                    <td class="font-weight-bold">{{ $buyouts[0]->company_name }}</td>
                                </tr>
                                <tr>
                                    <td>Contact Person:</td>
                                    <td class="font-weight-bold">{{ $buyouts[0]->contact_person }}</td>
                                </tr>
                                <tr>
                                    <td>Contact Number:</td>
                                    <td class="font-weight-bold">{{ $buyouts[0]->contact_number }}</td>
                                </tr>
                                <tr>
                                    <td>Total Amount:</td>
                                    <td class="font-weight-bold">{{ $buyouts[0]->total_amt  }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4 class="card-title">Buyout History</h4>
                        <div class="table-responsive">
                        
                            <table class="table table-striped">
                                <tr>
                                    <th>Company Name</th>
                                    <th>Contact Person</th>
                                    <th>Contact Number</th>
                                    <th>Total Amt</th>
                                    <th>Edited By</th>
                                </tr>
                                @foreach ($buyouts as $buy)
                                    <tr>
                                        <td>{{ $buy->company_name }}</td>
                                        <td>{{ $buy->contact_person }}</td>
                                        <td>{{ $buy->contact_number }}</td>
                                        <td>{{ $buy->total_amt }}</td>
                                        <td>{{ $buy->user->name }}</td>
                                    </tr>
                                @endforeach
                                
                                
                            </table>
                        </div>
                    </div>
                </div>
                @include('buyout.buyout_payment')
                @include('buyout.view_payment')
                {{-- @endforeach --}}
                </div>
            </div>
		</div>
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

		$(document).on("click", ".buyoutSelect", function () {
			var id = $(this).data('id');
			$('#buyoutSelect').find('.modal-body #hiddenId').val(id);
			// As pointed out in comments, 
			// it is unnecessary to have to manually call the modal.
			$('#buyoutSelect').modal('show');
		});

        $(document).on("click", ".viewPayment", function () {
			var id = $(this).data('id');
			// $('#buyoutSelect').find('.modal-body #hiddenId').val(id);
			// As pointed out in comments, 
			// it is unnecessary to have to manually call the modal.
			$('#viewDetails').modal('show');
		});
	 });

	 
	 
	</script>
@endsection
