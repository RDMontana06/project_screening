@extends('layouts.header')

@section('content')
	<div class="main-panel">
		<div class="content-wrapper">
			<div class="row">
				<div class="col-md-12 grid-margin">
					<div class="row">
						<div class="col-12 col-xl-8 mb-4 mb-xl-0">
							<h3 class="font-weight-bold">User Management</h3>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header bg-white text-dark mb-3 h4 font-weight-bold">Users
				<button type="button" class="btn btn-success btn-icon-text btn-rounded btn-sm ml-2" data-toggle="modal"
					data-target="#user"><span class="ti-plus btn-icon-prepend"></span>Add User
				</button>
				</div>
				<div class="card-body">
					<table class="table table-stripe table-hover" id="userTbl">
						<thead>
							<tr>
								<th>Email</th>	
								<th>Name</th>	
								<th>Date Created</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($users as $user )
							<tr>
								<td>{{ $user->email }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->created_at }}</td>
								<td>
									<button type="button" class="btn btn-primary btn-rounded btn-icon">
										<span class="ti-pencil" title="Edit"></span>
									</button>
									<button type="button" class="btn btn-danger btn-rounded btn-icon">
										<span class="ti-trash" title="Delete"></span>
									</button>
									<button type="button" class="btn btn-info btn-rounded btn-icon">
										<span class="ti-back-left" title="Reset Password"></span>
									</button>
								</td>
							</tr>
						@endforeach
							
						</tbody>
					</table>
				</div>
				@include('user.new_user')
			</div>
		</div>
	</div>

@endsection
@section('userScript')
<script>
	$(document).ready(function() {
	  $('#userTbl').DataTable({
	   pageLength: 5,
	   lengthMenu: [
	    [5, 10, 20],
	    [5, 10, 20]
	   ]
	  });
	 });
</script>
@endsection