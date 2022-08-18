<!-- Modal -->
<div class="modal fade" id="buyoutList" tabindex="-1" role="dialog" aria-labelledby="buyoutList" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="buyoutList">Buyout Project Inquiry</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
            <table class="table table-stripe table-hover" id="buyout-table">
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Product Type</th>
                        <th>Type</th>
                        <th>Location</th>
                        <th>Approved Budget</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects->where('status', 'Buyout') as $projectDetails)
                        <tr id='project{{ $projectDetails->id }}'>
                            <td>{{ $projectDetails->project_name }}</td>
                            <td>{{ $projectDetails->project_type }}</td>
                            <td>{{ $projectDetails->type }}</td>
                            <td>{{ $projectDetails->location }}</td>
                            <td>{{ number_format($projectDetails->approved_budget) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>