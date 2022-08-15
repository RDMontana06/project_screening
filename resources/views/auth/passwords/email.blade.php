@extends('layouts.app_auth')

@section('content')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <a href="{{ url('/') }}">
              <div class="brand-logo">
                <img src="{{URL::asset('/images/PMS-LOGO.svg')}}" alt="logo">
              </div>
            </a>
              <hr>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <h4>Forgot Password</h4>
                <p>Please enter your email and we'll send you instructions on how to reset your password</p>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group row">
                        {{-- <label for="email" class="col-md-3 col-form-label">{{ __('Email Address') }}</label> --}}

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-sm" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-block btn-primary btn-sm">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
