@extends('layouts.header')

@section('content')
	<div class="main-panel">
		<div class="content-wrapper">
			<div class="row">
				<div class="col-md-12 grid-margin">
					@include('errors')
					<div class="card">
						<div class="card-header bg-white text-dark mb-3 ">
							<h4 class="font-weight-bold d-flex justify-content-start align-items-center">Project Screening
								<button type="button" class="btn btn-dark btn-icon-text btn-rounded btn-sm ml-2" data-toggle="modal"
									data-target="#projectModal">
									<span class="ti-plus btn-icon-prepend"></span>Add Project
								</button>
							</h4>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered " id="projects-table">
									<thead>
										<tr>
											<th>Project Name</th>
											<th>Product Type</th>
											<th>Type</th>
											<th>Location</th>
											<th>Approved Budget</th>
											<th>Status</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($projects as $projectDetails)
											<tr id='project{{ $projectDetails->id }}'>
												<td>{{ $projectDetails->project_name }}</td>
												<td>{{ $projectDetails->project_type }}</td>
												<td>{{ $projectDetails->type }}</td>
												<td>{{ $projectDetails->location }}</td>
												<td>{{ number_format($projectDetails->approved_budget) }}</td>
												<td id="tdId{{ $projectDetails->id }}">
													{{-- <label id="label{{ $projectDetails->id }}" class="badge badge-info">{{ $projectDetails->status }}</label> --}}

													@if ($projectDetails->status == 'Cancelled')
														<label id="status{{ $projectDetails->id }}"
															class="badge badge-warning">{{ $projectDetails->status }}</label>
													@elseif ($projectDetails->status == 'Pending')
														<label id="status{{ $projectDetails->id }}"
															class="badge badge-info">{{ $projectDetails->status }}</label>
													@elseif ($projectDetails->status == 'Approved')
														<label id="status{{ $projectDetails->id }}"
															class="badge badge-success">{{ $projectDetails->status }}</label>
													@elseif ($projectDetails->status == 'Buyout')
														<label id="approvalStatus{{ $projectDetails->id }}"
															class="badge badge-primary">{{ $projectDetails->status }}</label>
													@else
														<label id="status{{ $projectDetails->id }}"
															class="badge badge-danger">{{ $projectDetails->status }}</label>
													@endif

												</td>
												<td style="width:10%;" class="">
													@if ($projectDetails->status == 'Pending')
														<button type="button" class="btn btn-icon btn-danger btn-sm cancelBtn" id="{{ $projectDetails->id }}"
															title="Cancel Project" onclick="cancelProj(this.id)">
															<span class="ti-close"></span>
														</button>
													@endif
													<button type="button" data-toggle="modal" data-target="#viewProject{{ $projectDetails->id }}"
														class="btn btn-icon btn-info btn-sm" title="View Project">
															<span class="ti-eye"></span>
													</button>
													@include('projectScreening.show_project')
												</td>
											</tr>
											@include('projectScreening.edit_project_form')
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				@include('projectScreening.project_form')
			</div>
		</div>
		@include('layouts.footer')
	</div>
	</div>
@endsection
@section('psScript')
	<script>
	 // Project Datatable
	 //  var projects = {!! json_encode($projects->toArray()) !!};
	 //  console.log(projects);
	 $(document).ready(function() {
	  $('#projects-table').DataTable({
	   pageLength: 5,
	   lengthMenu: [
	    [5, 10, 20],
	    [5, 10, 20]
	   ]
	  });
	 });
	 //  Add New Contact
	 function addContacts() {
	  var idContact = $('#contactDetails').children().last().attr('id');
	  var idContactData = parseInt(idContact) + 1;
	  console.log(idContactData);

	var divInput = '<div id="idContactData">';
	  	divInput += '<div class="row align-items-center">';
			divInput += '<div class="col-sm-5">';
				divInput += '<div class="form-group">';
					divInput += '<label for="companyName">Contact Number(s)</label>';
					divInput +='<input type="text" class="form-control"  name="contactNum[]" placeholder="Contact Number">';
				divInput += '</div>';
			divInput += '</div>';
			divInput += '<div class="col-sm-5">';
				divInput += '<div class="form-group">';
					divInput += '<label for="companyName">Contact Person(s)</label>';
					divInput += '<input type="text" class="form-control"  name="contactPerson[]" placeholder="Contact Person">';
				divInput += '</div>';
			divInput += '</div>';

			divInput += '<div class="col-sm-2">';
				divInput += '<div class="form-group d-flex vertical-align-bottom mb-0">';
					divInput +='<button type="button" class="form-control btn btn-danger btn-sm" onclick="deleteRow()"><span   class="ti-trash"></span></button>';
				divInput += '</div>';
	  		divInput += '</div>';
	  	divInput += '</div>';
	divInput += '</div>';
	
	  $('#contactDetails').append(divInput);
	 }

	 function deleteRow() {
	  $('#idContactData').remove();
	 }

	 // Edit New Contacts
	 function addEditContacts(asd) {
	  var idEditContact = $('#contactEdit' + asd).children().last().attr('id');
	  var idx = idEditContact.split('-');
	  var idEditContactData = parseInt(idx[2]) + 1;

	  console.log(idEditContact);
	  console.log(idx);
	  console.log(idEditContactData);

	  var divInputEdit = '<div class="row" id="editId-' + asd + '-' + idEditContactData + '">';
	  divInputEdit += '<div class="col-sm-6">';
	  divInputEdit += '<label for="companyName">Contact Number(s)</label>';
	  divInputEdit +=
	   '<input type="text" class="form-control" id="contactNum" name="contactNum[]" placeholder="Contact Number">';
	  divInputEdit += '</div>';
	  divInputEdit += '<div class="col-sm-6">';
	  divInputEdit += '<label for="companyName">Contact Person(s)</label>';
	  divInputEdit +=
	   '<input type="text" class="form-control" id="contactPerson" name="contactPerson[]" placeholder="Contact Person" required>';
	  divInputEdit += '</div>';
	  divInputEdit += '<div class="col-md-2">';
	  divInputEdit += '<label for="action">Action</label>';
	  divInputEdit += '<button type="button" class="form-control btn btn-danger btn-sm" onclick="deleteEditNewRow(`' + asd +
   '`,`' + idEditContactData + '`)"><span class="ti-trash"></span></button>';
	  divInputEdit += '</div>';
	  divInputEdit += '</div>';
	  $('#contactEdit' + asd).append(divInputEdit);

	 }
	 // Delete New Row in Contact
	 function deleteEditNewRow(ss, dd) {
	  console.log(ss + '-' + dd);
	  $('#editId-' + ss + '-' + dd).remove()
	 }
	 // Cancel Project Function
	 function cancelProj(id) {
	  Swal.fire({
	   title: 'Cancel this project',
	   text: "Are you sure about this?",
	   icon: 'warning',
	   showCancelButton: true,
	   confirmButtonColor: '#3085d6',
	   cancelButtonColor: '#d33',
	   confirmButtonText: 'Yes'
	  }).then((result) => {
	   if (result.isConfirmed) {
	    $.ajax({
	     url: "cancelProjet/" + id,
	     method: "POST",
	     data: {
	      id: id
	     },
	     headers: {
	      'X-CSRF-TOKEN': '{{ csrf_token() }}'
	     },
	     success: function(data) {
	      swal.fire(
	       'Cancelled!',
	       'Project has been cancelled!',
	       'success'
	      ).then(function() {
	       var newlabel = document.createElement("Label");
	       newlabel.setAttribute("class", "badge badge-warning");
	       newlabel.innerHTML = "Cancelled";
	       // Append new label
	       document.querySelector('#tdId' + id).appendChild(newlabel);
	       // Remove Elements
	       document.querySelector('#status' + id).remove();
	       document.getElementById(id).remove();

	      });
	     }
	    })
	   } else if (
	    result.dismiss === Swal.DismissReason.cancel
	   ) {
	    swal.fire(
	     'Cancelled',
	     'Project is safe',
	     'error'
	    )
	   }
	  })
	 }
	 // Show Company Field when existing
	 var el = document.getElementById("SelectType");
	 el.addEventListener("change", function() {
	  var elems = document.querySelectorAll('#selectCompany,#inputCompany')
	  for (var i = 0; i < elems.length; i++) {
	   elems[i].style.display = 'none'
	  }
	  console.log('Selected');
	  const selInput = document.getElementById('selectComp');
	  let compName = document.querySelector("#companyName");
	  if (this.selectedIndex === 0) {

	  }else if ((this.selectedIndex === 1) || (this.selectedIndex === 3)) {
	   document.querySelector('#inputCompany').style.display = 'block';
	   document.getElementById("companyName").required = true;
	   document.getElementById("selectComp").required = false;
	   document.getElementById('select2-selectComp-container').innerHTML = "Select Company";
	   document.querySelector('#selectCompany').style.display = 'none';
	   reset("selectComp");
	  } else if (this.selectedIndex === 2) {
	   document.querySelector('#selectCompany').style.display = 'block';
	    document.getElementById("companyName").required = false;
	   document.getElementById("selectComp").required = true;
	   document.querySelector('#inputCompany').style.display = 'none';
	   reset("companyName");
	  } 
	 }, false);

	 function reset(id_input)
	 {
		document.querySelector("#"+id_input).value = "";
	 }
	</script>
@endsection
