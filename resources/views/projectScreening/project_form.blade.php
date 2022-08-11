<!-- Project Modal -->
<div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
    <form class="forms-sample" method="post" action="newProject" enctype="multipart/form-data">
        {{csrf_field()}}
      <div class="modal-header">
      
        <h4 class="modal-title" id="projectModalLabel">New Project
         <button type="submit" class="btn btn-info btn-sm"><span class="ti-save"></span> Save</button>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            {{-- <div class="form-group">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">PSF-</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Reference Code" aria-label="refcode" aria-describedby="basic-addon1" name="ref_code" id="refCode">
                </div>
            </div> --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="projectName">Project Name</label>
                        <input type="text" class="form-control form-control-sm" id="projectName" name="project_name" placeholder="Project Name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="projectType">Project Type</label>
                        <input type="text" class="form-control form-control-sm" id="projectType" name="project_type" placeholder="Project Type">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control form-control-sm" id="location" name="location" placeholder="Location">
                    </div>
                </div>
            </div>
            <hr>
            <h5 class="mb-3">Client Details</h5>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control form-control-sm" id="SelectType" name="type">
                            <option value="">-- Select Type --</option>
                            <option value="New">New</option>
                            <option value="Existing">Existing</option>
                            <option value="with Partnership Agreement">with Partnership Agreement</option>
                        </select>
                    </div>
                    <div class="form-group" id="inputCompany">
                        <label for="companyName">Company Name</label>
                        <input type="text" class="form-control form-control-sm" id="companyName" name="company_name" placeholder="Company Name">
                    </div>
                    <div class="form-group" id="selectCompany">
                        <select class="js-example-basic-single" name="company_name" style="width:100%;">
                            <option value="option" disabled selected>Select Company</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->company_name }}">{{ $project->company_name}}</option>
                                @endforeach
                        </select>
                  </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control form-control-sm" id="address" name="address" placeholder="Address">
                    </div>
                    
                </div>
                <div class="col-sm-6">
                    <h5 class="mb-3">Contact Details 
                        <button type="button" class="btn btn-dark btn-sm" onclick="addContacts()">Add New Contact</button>
                    </h5>
                    <div id="contactDetails">
                        <div class="form-group" id="">
                            <label for="contactNum">Contact Number(s)
                            {{-- <button type="button" class="btn btn-dark btn-sm" onclick="addNumber()"><span class="ti-plus"></span></button> --}}
                            </label>
                            <input type="text" class="form-control form-control-sm" id="contactNum" name="contactNum[]" placeholder="Contact Number">
                        </div>
                        <div class="form-group">
                            <label for="contactPerson">Contact Person(s)
                            {{-- <button type="button" class="btn btn-dark btn-sm" onclick="addContactPer()"><span class="ti-plus"></span></button> --}}
                            </label>
                            <input type="text" class="form-control form-control-sm" id="contactPerson" name="contactPerson[]" placeholder="Contact Person">
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="approvedBudget">Approved Budget</label>
                        <input type="number" class="form-control form-control-sm" id="approvedBudget" name="approved_budget" placeholder="Approved Budget">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Project Details</label>
                        <input type="file" name="file[]" class="form-control form-control-sm" multiple>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="remarks">Remarks</label>
                <textarea class="form-control form-control-sm" id="remarks" name="remarks" rows="4"></textarea>
            </div>
            
      </div>
      <div class="modal-footer">
        {{-- <button type="submit" class="btn btn-info"><span class="ti-save"></span> Save</button> --}}
      </div>
      </form>
    </div>
  </div>
</div>