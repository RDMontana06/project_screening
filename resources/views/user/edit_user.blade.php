<div class="modal fade" id="editUser{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUser" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Modify User</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
           <form method="POST" action="updateUser/{{ $user->id }}">
            @csrf
            <div class="form-group row">
                <label class="" for="first_name">Name</label>
                <input value='{{ $user->name }}' type="text" name="name" class="form-control">
            </div>
            <div class="form-group row">
                <label for="roles">Roles</label>
                <select class="form-control form-control-lg js-example-basic-multiple" name="role[]" multiple="multiple" placeholder="Select Roles" style="width:100% !important;">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}"
                            {{ in_array($role->id, $user->user_roles->pluck('role_id')->toArray())? 'selected' : ''}}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm">
           <span class="ti-save"></span> Save Changes
        </button>
      </div>
      </form>
    </div>
  </div>
</div>