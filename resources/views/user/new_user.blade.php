<div class="modal fade" id="user" tabindex="-1" role="dialog" aria-labelledby="user" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">New User</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('saveUser') }}">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">{{ __('Name') }}</label>
								<input id="name" type="text"
									class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} form-control-sm" name="name"
									value="{{ old('name') }}" required autofocus>

								@if ($errors->has('name'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif
							</div>
							<div class="form-group">
								<label for="password">{{ __('Password') }}</label>
								<input id="password" type="password"
									class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} form-control-sm" name="password"
									required>

								@if ($errors->has('password'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="email">{{ __('Email Address') }}</label>
								<input id="email" type="email"
									class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-sm" name="email"
									value="{{ old('email') }}" required>

								@if ($errors->has('email'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif
							</div>
							<div class="form-group">
								<label for="password-confirm">{{ __('Confirm Password') }}</label>
								<input id="password-confirm" type="password" class="form-control form-control-sm" name="password_confirmation"
									required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="roles">Roles</label>
								<select class="form-control form-control-sm js-example-basic-multiple" name="role[]" multiple="multiple"
									style="width:100% !important;">
									@foreach ($roles->where('name', '!=', 'Requestor') as $role)
										<option value="{{ $role->id }}">{{ $role->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
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
