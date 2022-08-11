<div class="modal fade" id="user" tabindex="-1" role="dialog" aria-labelledby="user" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">New User</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
           <form method="POST" action="{{ route('saveUser') }}">
            @csrf

            <div class="form-group row">
                <label for="name">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} form-control-lg" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group row">
                <label for="email">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-lg" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group row">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} form-control-lg" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group row">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" required>
            </div>

            <div class="form-group row">
                <label for="roles">Roles</label>
                <select class="form-control form-control-lg js-example-basic-multiple" name="role[]" multiple="multiple" placeholder="Select Roles" style="width:100% !important;">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}"
                            {{ in_array($role->id, $user->user_roles->pluck('role_id')->toArray())}}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

        
        </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">
           <span class="ti-save"></span> {{ __('Save') }}
        </button>
      </div>
      </form>
    </div>
  </div>
</div>