<!-- Modal -->
<div class="modal fade" id="buyoutHistory" tabindex="-1" role="dialog" aria-labelledby="buyoutHistory" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="buyoutHistory">Buyout History <span class="text-muted font-weight-sm"><mark><small>Fully Paid Projects</small></mark></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
            <table class="table table-stripe table-hover" id="buyoutHist-tbl">
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
                {{-- {{ dd($projects) }} --}}
                    @foreach ($projects as $projectDetails)
                    @if (($projectDetails->bo_companies)->count())
                       @if ($projectDetails->bo_companies[0]->status == 'Fully Paid')
                          <tr id='project{{ $projectDetails->id }}'>
                            <td>{{ $projectDetails->project_name }}</td>
                            <td>{{ $projectDetails->project_type }}</td>
                            <td>{{ $projectDetails->type }}</td>
                            <td>{{ $projectDetails->location }}</td>
                            <td>{{ number_format($projectDetails->approved_budget) }}</td>
                          </tr>
                        @endif
                    @endif
                         
                            
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline-primary">Save changes</button>
      </div> --}}
    </div>
  </div>
</div>