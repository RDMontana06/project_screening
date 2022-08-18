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
                @include('errors')
				<div class="card-body">
					<table class="table table-stripe table-hover" id="userTbl">
						<thead>
							<tr>
								<th>Email</th>	
								<th>Name</th>	
								<th>Date Created</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($users as $user )
							<tr>
								<td>{{ $user->email }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->created_at }}</td>
								<td id="statusTdId{{ $user->id }}">
									@if ($user->status == 1)
										<span class="badge bg-success text-white" id="status{{ $user->id }}">Active</span>
									@else
										<span class="badge bg-danger text-white" id="status{{ $user->id }}">Enactive</span>
									@endif
								</td>
								<td id="tdActionId{{ $user->id }}" data-id="{{ $user->id }}">
									@if ($user->status == 1)
										<button type="button" id="{{ $user->id }}" data-toggle="modal"
											data-target="#editUser{{ $user->id }}" title="Edit" class="btn btn-primary btn-rounded btn-icon">
											<span class="ti-pencil" ></span>
										</button>
 										@if (!in_array(1, $user->user_roles->pluck('role_id')->toArray()))
											<button type="button" title="Deactivate" id="{{ $user->id }}" onclick="disableUser({{ $user->id }})" class="btn btn-danger btn-rounded btn-icon">
												<span class="ti-trash" ></span>
											</button>
										@endif

										<button type="button" title="Reset Password" data-toggle="modal"
                                        	data-target="#change_pass{{ $user->id }}"  class="btn btn-info btn-rounded btn-icon">
											<span class="ti-back-left" ></span>
										</button>
									@else
										<button type="button" id="{{ $user->id }}" onclick="activateUser(this.id)"
											class="activateBTn btn btn-success btn-rounded btn-icon" title="Activate">
											<span class="ti-check"></span>
										</button>
									@endif
								</td>
							</tr>
							@include('user.edit_user')
                            @include('user.reset_password')
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
	//  Disable User
	

	function disableUser(id) {
		var element = document.getElementById('tdActionId' + id);
    	var dataID = element.getAttribute('data-id');
            // console.log(id);
            // console.log(dataID);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            })

            swalWithBootstrapButtons.fire({
                title: 'Deactivate User?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, deactivate it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: false,
                confirmButtonColor: '#218838',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "disableUser/" + id,
                        method: "POST",
                        data: {
                            id: id
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            swalWithBootstrapButtons.fire(
                                'Deactivated!',
                                'User has been deactivated.',
                                'success'
                            ).then(function() {
                                document.getElementById("statusTdId" + id).innerHTML =
                                    "<span class='badge bg-danger text-white'>Enactive</span>";
                                document.getElementById("tdActionId" + dataID).innerHTML = "<button type='button' id='action" +
                                    id + "' onclick='activateUser(" + id +
                                    ")' class='activateBTn btn btn-success btn-rounded btn-icon' title='Activate'><span class='fa ti-check'></span></button>";

                            });
                        }
                    });
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your file is safe',
                        'error'
                    )
                }
            })
        }
	// Activate User
	function activateUser(id) {
		var element = document.getElementById('tdActionId' + id);
    	var dataID = element.getAttribute('data-id');
            // console.log("act" + id);
            // console.log("data" + dataID);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            })

            swalWithBootstrapButtons.fire({
                title: 'Activate User?',
                text: "You won't be able to revert this!",
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: 'Yes, activate it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: false,
                confirmButtonColor: '#218838',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "activateUser/" + id,
                        method: "POST",
                        data: {
                            id: id
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            swalWithBootstrapButtons.fire(
                                'Activated!',
                                'User has been Activated.',
                                'success'
                            ).then(function() {
                                document.getElementById("statusTdId" + id).innerHTML =
                                    "<span class='badge bg-success text-white'>Active</span>";
                                document.getElementById("tdActionId" + dataID).innerHTML = 
								"<button type='button' id='edit(" + id + ")' data-toggle='modal' data-target='#editUser" + id +
                                    "' class='btn btn-primary btn-rounded btn-icon' title='Edit'><span class='ti-pencil'></span></button> <button type='button' id='action" + id + "' onclick='disableUser(" + id +
                                    ")' class='btn btn-danger btn-rounded btn-icon' title='Deactivate'><span class='ti-trash'></span></button> <button type='button' id='reset" + id + "' data-toggle='modal' data-target='#change_pass" + id +
                                    "' class='resetBtn btn btn-info btn-rounded btn-icon' title='Reset Password'><span class='fa ti-back-left'></span></button>";

                            });
                        }
                    });
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your file is safe',
                        'error'
                    )
                }
            })
        }
</script>
@endsection