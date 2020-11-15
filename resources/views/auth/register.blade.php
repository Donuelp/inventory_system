@extends('layouts.app', [
  'class' => 'register-page',
  'classPage' => 'register-page',
  'activePage' => 'register',
  'title' => __('Register')
])

@section('content')
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-register card-white">
          {{-- <div class="card-header">
            <img class="card-img" src="{{ asset('black') }}/img/card-primary.png" alt="Card image">
            <h5 class="card-title">{{ __('Add Employee') }}</h5>
            <h2 style="color: #e14eca; text-align: center;" class="pt-5">Add Employee</h2>
          </div> --}}
          <div class="card-body pt-5">
            <form class="form" id="register-form" method="POST" action="{{ route('register') }}">
              @csrf
              <div class="form-group mb-0 {{ $errors->has('name') ? ' has-danger' : '' }}">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="tim-icons icon-single-02"></i>
                    </div>
                  </div>
                  <input type="text" name="name" class="form-control" placeholder="{{ __('Name...') }}" value="{{ old('name') }}" required>
                </div>
                @include('alerts.feedback', ['field' => 'name'])
              </div>
              <div class="form-group mb-0 {{ $errors->has('name') ? ' has-danger' : '' }}">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="tim-icons icon-email-85"></i>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="email" placeholder="{{ __('Email...') }}" value="{{ old('email') }}" required>
                </div>
                @include('alerts.feedback', ['field' => 'email'])
              </div>
              <div class="form-group mb-0 {{ $errors->has('name') ? ' has-danger' : '' }}">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="tim-icons icon-user-run"></i>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="user_name" placeholder="{{ __('Username') }}" value="{{ old('user_name') }}" required>
                </div>
                @include('alerts.feedback', ['field' => 'user_name'])
              </div>
              <div class="form-group mb-0 {{ $errors->has('name') ? ' has-danger' : '' }}">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="tim-icons icon-email-85"></i>
                    </span>
                  </div>
                  <select class="form-control" name="user_type" title="" data-size="100">
                    <option value="" selected hidden>{{ __('User Type') }}</option>
                    <option value="1" @if (old('user_type') == '1') selected="selected" @endif>{{ __('Admin') }}</option>
                    <option value="2" @if (old('user_type') == '2') selected="selected" @endif>{{ __('User') }}</option>
                    {{-- <option value="3" @if (old('user_type') == '3') selected="selected" @endif>{{ __('Member') }}</option> --}}
                  </select>
                </div>
                @include('alerts.feedback', ['field' => 'user_type'])
              </div>
              <div class="form-group mb-0 {{ $errors->has('name') ? ' has-danger' : '' }}">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="tim-icons icon-lock-circle"></i>
                    </div>
                  </div>
                  <input type="password" name="password" placeholder="{{ __('Password...') }}" class="form-control" required>
                </div>
                @include('alerts.feedback', ['field' => 'password'])
              </div>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="tim-icons icon-lock-circle"></i>
                  </div>
                </div>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password...') }}" required>
              </div>
            </form>
          </div>
          <div class="card-footer">
            <center>
              <div class="col-md-12">
                <a href="javascript:void(0)" onclick="event.preventDefault();
                document.getElementById('register-form').submit();" class="btn btn-primary btn-round btn-lg ml-auto mr-auto">Add Employee</a>
              </div>
            </center>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      demo.checkFullPageBackgroundImage();
    });
  </script>
@endpush
