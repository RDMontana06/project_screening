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
                                    <td width="30%" class="font-weight-bold">Company Name</td>
                                    <td>{{ $buyouts[0]->company_name }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Contact Person</td>
                                    <td>{{ $buyouts[0]->contact_person }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Contact Number</td>
                                    <td>{{ $buyouts[0]->contact_number }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Total Amount</td>
                                    <td>{{ number_format($buyouts[0]->total_amt, 2)  }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Running Balance</td>
                                    <td>
                                        @if ( ($buyouts[0]->payments)->sum('amount') > 0)
                                            <span class="badge badge-success">
                                                {{ number_format($buyouts[0]->total_amt - ($buyouts[0]->payments)->sum('amount') )}}
                                            </span>
                                        @endif
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
                                    <td>{{ $buyouts[0]->project->project_name }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Project Type</td>
                                    <td>{{ $buyouts[0]->project->project_type }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Reference Code</td>
                                    <td>{{ $buyouts[0]->project->ref_code }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Location</td>
                                    <td>{{ $buyouts[0]->project->location }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Company Name</td>
                                    <td>{{ $buyouts[0]->project->company_name }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Type</td>
                                    <td>{{ $buyouts[0]->project->type }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Approved Budget</td>
                                    <td>{{ number_format($buyouts[0]->project->approved_budget, 2) }}</td>
                                </tr>
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
