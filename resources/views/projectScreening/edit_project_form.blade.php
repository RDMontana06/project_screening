<!-- Project Modal -->
<div class="modal fade" id="editProject{{$projectDetails->id}}" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="">Modify Project</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="forms-sample" method="post" action="editProject/{{$projectDetails->id}}" enctype="multipart/form-data">
        {{csrf_field()}}
            <div class="form-group">
                <label for="projectName">Project Name</label>
                <input type="text" class="form-control" value="{{$projectDetails->project_name}}" id="" name="project_name" placeholder="Project Name">
            </div>
            <div class="form-group">
                <label for="projectType">Project Type</label>
                <input type="text" class="form-control" id="" value="{{$projectDetails->project_type}}" name="project_type" placeholder="Project Type">
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control" id="" value="{{$projectDetails->location}}" name="location" placeholder="Location">
            </div>
            <hr>
            <h5 class="mb-3">Contact Details 
                <button type="button" class="btn btn-dark btn-sm" onclick="addEditContacts({{$projectDetails->id}})">Add New Contact</button>
            </h5>
                <div class="form-group" id="contactEdit{{$projectDetails->id}}" >
                @foreach($projectDetails->contact as $key => $contact)
                    <div class="row" id='editId-{{$projectDetails->id}}-{{$key}}'>
                        <div class="col-md-5">
                            <label for="contactNum">Contact Number(s)
                            {{-- <button type="button" class="btn btn-dark btn-sm" onclick="addNumber()"><span class="ti-plus"></span></button> --}}
                            </label>
                            <input type="text" class="form-control" id="" name="contactNum[]" placeholder="Contact Number" value="{{ $contact->contact_number}}">
                        </div>
                        <div class="col-md-5">
                            <label for="contactPerson">Contact Person(s)
                            {{-- <button type="button" class="btn btn-dark btn-sm" onclick="addContactPer()"><span class="ti-plus"></span></button> --}}
                            </label>
                            <input type="text" class="form-control" id="" name="contactPerson[]" placeholder="Contact Person" value='{{ $contact->contact_name}}'>
                        </div>
                        @if($key != 0)
                        <div class="col-md-2"> 
                            <label for="action">Action</label>
                            <button type="button" class="form-control btn btn-danger btn-sm" onclick="deleteEditNewRow({{$projectDetails->id}},{{$key}})"><span class="ti-trash"></span></button>  
                        </div>  
                        @endif
                    </div>
                    @endforeach
                </div>
              
            <hr>
            <h5 class="mb-3">Client Details</h5>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="companyName">Company Name</label>
                        <input type="text" class="form-control" id="" value="{{$projectDetails->company_name}}" name="company_name" value="" placeholder="Company Name">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="" value="{{$projectDetails->address}}" name="address" placeholder="Address">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" id="" name="type">
                            <option>-- Select Type --</option>
                            <option {{ ($projectDetails->type == "New" ?  'selected="selected"' : '')  }}>New</option>
                            <option {{ ($projectDetails->type == "Existing" ?  'selected="selected"' : '')  }}>Existing</option>
                            <option {{ ($projectDetails->type == "with Partnership Agreement" ? 'selected="selected"' : '') }}>with Partnership Agreement</option>
                        </select>
                        
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="approvedBudget">Approved Budget</label>
                        <input type="number" class="form-control" id="" value="{{$projectDetails->approved_budget}}" name="approved_budget" placeholder="Approved Budget">
                    </div>
                    <div class="form-group">
                      <label>Project Details</label>
                      <input type="file" name="file[]" value="" class="form-control" multiple>
                        @foreach($projectDetails->attachment as $key => $attachment)
                        {{$attachment->attachment}}
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="remarks">Remarks</label>
                <textarea class="form-control" id="" value="" name="remarks" rows="4">{{$projectDetails->remarks}}</textarea>
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
