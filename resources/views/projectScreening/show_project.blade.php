<div class="modal fade" id="viewProject{{$projectDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="viewProject" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Project Details</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-4">
              <h4>Project Name</h4>
              <p>{{ $projectDetails->project_name }}</p>
            </div>
            <div class="col-md-4">
              <h4>Project Type</h4>
              <p>{{ $projectDetails->project_type }}</p>
            </div>
            <div class="col-md-4">
              <h4>Location</h4>
              <p>{{ $projectDetails->location }}</p>
            </div>
          </div>
          <hr>
          <h3>Client Details</h3>
          <hr>
          <div class="row">
            <div class="col-md-3">
              <h4>Type</h4>
              <p>{{ $projectDetails->type }}</p>
            </div>
            <div class="col-md-3">
              <h4>Company Name</h4>
              <p>{{ $projectDetails->company_name }}</p>
            </div>
            <div class="col-md-3">
              <h4>Address</h4>
              <p>{{ $projectDetails->address }}</p>
            </div>
            <div class="col-md-3">
              <h4>Contacts</h4>
                @if(count($projectDetails->contact) > 1)
                  @foreach ($projectDetails->contact as $contact)
                  <ul>
                    <li>Name: {{ $contact->contact_name }}</li>
                    <li>Number: {{ $contact->contact_number }}</li>
                  </ul>
                  @endforeach
                @else
                  @foreach ($projectDetails->contact as $contact)
                  <ul>
                    <li>Name: {{ $contact->contact_name }}</li>
                    <li>Number: {{ $contact->contact_number }}</li>
                  </ul>
                  @endforeach
                @endif
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-6">
              <h4>Attachments</h4>
                <ul>
                  @foreach ($projectDetails->attachment as $attachment)
                    <li>
                      <a href="{{ url($attachment->attachment) }}" target='_blank'>{{ $attachment->attachment }}</a>
                    </li>
                  @endforeach
                </ul>
            </div>
            <hr>
              <div class="col-md-6">
                  <h4>Approved Budget</h4>
                  <p>{{ number_format($projectDetails->approved_budget, 2)}}</p>
              </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <h4>Remarks</h4>
                <p>{{ $projectDetails->remarks }}</p>
            </div>
          </div>
        </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>