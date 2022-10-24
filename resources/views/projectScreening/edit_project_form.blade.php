<!-- Project Modal -->
<div class="modal fade" onload="edit()" id="editProject{{ $projectDetails->id }}" tabindex="-1"
	aria-labelledby="projectModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="">Modify Project</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="" id="editFormId" method="post" action="updateProject/{{ $projectDetails->id }}"
					enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="projectName">Project Name</label>
								<input type="text" class="form-control" value="{{ $projectDetails->project_name }}"
									id="editProjName{{ $projectDetails->id }}" name="project_name" placeholder="Project Name">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="projectType">Project Type</label>
								<input type="text" class="form-control" id="editProjType{{ $projectDetails->id }}"
									value="{{ $projectDetails->project_type }}" name="project_type" placeholder="Project Type">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="location">Location</label>
								<input type="text" class="form-control" id="editLoc{{ $projectDetails->id }}"
									value="{{ $projectDetails->location }}" name="location" placeholder="Location">
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="type">Type {{ $projectDetails->id }}</label>
								<select class="form-control" id="selType{{ $projectDetails->id }}"
									onchange="changeType('{{ $projectDetails->id }}'); return false;" name="type">
									<option>-- Select Type --</option>
									<option {{ $projectDetails->type == 'New' ? 'selected="selected"' : '' }}>New</option>
									<option {{ $projectDetails->type == 'Existing' ? 'selected="selected"' : '' }}>Existing
									</option>
									<option {{ $projectDetails->type == 'With Partnership Agreement' ? 'selected="selected"' : '' }}>with
										Partnership Agreement</option>
								</select>

							</div>
							<div class="form-group" id="editCompanyName{{ $projectDetails->id }}">
								<label for="companyName">Company Name</label>
								<input type="text" value="{{ $projectDetails->company_name }}" class="form-control form-control-sm"
									id="eCompName{{ $projectDetails->id }}" name="company_name" placeholder="Company Name">
							</div>
							<div class="form-group" id="editSelectCompany{{ $projectDetails->id }}">
								<select class="js-example-basic-single" id="eSelComp{{ $projectDetails->id }}" name="comp"
									style="width:100%;">
									<option value="selected" disabled selected>Select Company</option>
									@foreach ($projects as $project)
										<option value="{{ $project->company_name }}">{{ $project->company_name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="address">Address</label>
								<input type="text" class="form-control" id="editAdd{{ $projectDetails->id }}"
									value="{{ $projectDetails->address }}" name="address" placeholder="Address">
							</div>
						</div>
						<div class="col-sm-6">
							<h5 class="mb-3">Contact Details
								{{-- <button type="button" class="btn btn-dark btn-sm" onclick="addEditContacts({{ $projectDetails->id }})">Add New
									Contact</button> --}}
							</h5>
							<div id="contactEditOld{{ $projectDetails->id }}">
								@foreach ($projectDetails->contact as $key => $contact)
									@if ($contact->status == 1)
										<div class="row" id='editIdOld-{{ $contact->id }}-{{ $key }}'>
											<div class="col-md-5">
												<label for="contactNum">Contact Number
												</label>
												<input type="text" class="form-control" id="editContactId{{ $contact->id }}"
													name="editContactNumOld[{{ $contact->id }}]" placeholder="Contact Number"
													value="{{ $contact->contact_number }}" required>
											</div>
											<div class="col-md-5">
												<label for="contactPerson">Contact Person
												</label>
												<input type="text" class="form-control" id="editConPersonId{{ $contact->id }}"
													name="editContactPersonOld[{{ $contact->id }}]" placeholder="Contact Person"
													value='{{ $contact->contact_name }}' required>
											</div>
											@if ($key != 0)
												<div class="col-md-2">
													<label for="action">Action</label>
													<button type="button" class="form-control btn btn-danger btn-sm btn-icon"
														onclick="deleteEditNewRowOld({{ $contact->id }},{{ $key }})"><span
															class="ti-trash"></span></button>
												</div>
											@endif
										</div>
									@endif
								@endforeach
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="approvedBudget">Approved Budget</label>
								<input type="number" class="form-control" id="editAppBud{{ $projectDetails->id }}"
									value="{{ $projectDetails->approved_budget }}" name="approved_budget" placeholder="Approved Budget">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Project Details</label>
								<input type="file" name="file[]" value="" id="editProjDet{{ $projectDetails->id }}"
									class="form-control" multiple>
								@if ($projectDetails->attachment)
									@foreach ($projectDetails->attachment as $key => $attachments)
										@if ($attachments->status == 1)
											<div id="fileIdx{{ $attachments->id }}">
												<span>{{ $attachments->attachment }} </span>
												{{-- <input type="text" name="oldFiles[]]" id="" value={{ attachments->id }}> --}}
												<span>
													<button type="button" class="btn btn-danger btn-sm"
														onclick="removeFile({{ $attachments->id }})">x</button>
												</span>
											</div>
										@endif
										<input type="text" name="filesAttach[]" value="{{ $attachments->id }}"
											id="editA{{ $attachments->id }}" hidden>
									@endforeach
								@endif
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="remarks">Remarks</label>
						<textarea class="form-control" id="editRem{{ $projectDetails->id }}" value="" name="remarks" rows="4">{{ $projectDetails->remarks }}</textarea>
					</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Update changes</button>
			</div>
			</form>
		</div>
	</div>
</div>
