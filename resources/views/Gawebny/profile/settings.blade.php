<!-- Page Content -->
@extends('Gawebny.layouts.layout')
@section('title')
{{ trans('profile.Settings') }}
@endsection
@section('header')
@endsection
@section('content')
<div class="container-custom">
  <div class="row">
    <!-- /.col-lg-6 -->
    <div class="col-lg-3">
      <div class=" aff-right">
        <div class="ui-block">
          <h6 class="my-4">{{ trans('profile.Settings') }}</h6>
          <div class="nav flex-column nav-pills nav-stacked" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link {{request()->is('settings/information') ? 'active' : ''}} "  href="{{ url('settings/information') }}" >{{ trans('profile.Account_Information') }}</a>
            <a class="nav-link {{request()->is('settings') ? 'active' : ''}}"  href="{{ url('settings') }}" >{{ trans('profile.Account_Settings') }} </a>
          </div>

        </div>
      </div>
    </div>
    <div class="col-lg-9">
      <p> {{ trans('profile.Account_Settings') }}
        <hr>
        <form method="Post" action="{{ url('settings1') }}" >
          @csrf
          @method('PUT')
          
          <div class="form-group row">
            <label for="example-url-input" class="col-2 col-form-label">{{ trans('profile.name') }}</label>
            <div class="col-10">
              <input class="form-control"  required name="name" type="text" value="{{$user->name}}" id="example-url-input">
              @if ($errors->has('name'))
              <strong>{{ $errors->first('name') }}</strong>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label for="example-url-input" class="col-2 col-form-label">{{ trans('profile.email') }}</label>
            <div class="col-10">
              <input class="form-control" required name="email" type="email" value="{{$user->email}}" id="example-url-input">
              @isset ($user->email_verified_at)
              {{ trans('profile.Your_Email_Is_Varivied') }} <i class= "fa fa-check"></i>
              @else
              {{ trans('profile.Please_Varifey_Your_Email') }}  <a href="{{ route('verification.resend') }}">{{ trans('profile.click_here_to_send_request') }}</a>
              @endisset
              @if ($errors->has('email'))
              <strong>{{ $errors->first('email') }}</strong>
              @endif
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{ trans('profile.Save') }}</button>
          </div>
        </form>
        @isset ($user->password)

        <form method="Post" action="{{ url('settings/password') }}" >
          @csrf
          @method('PUT')
          <p> {{ trans('profile.Change_Password') }}
            <hr>
            <div class="form-group row">
              <label for="example-url-input" class="col-2 col-form-label">{{ trans('profile.The_old_Password') }}</label>
              <div class="col-10">
                <input class="form-control" name="old_password" type="password" >
                @if ($errors->has('old_password'))
                <strong>{{ $errors->first('old_password') }}</strong>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="example-url-input" class="col-2 col-form-label">{{ trans('profile.The_New_Password') }}</label>
              <div class="col-10">
                <input class="form-control" name="password" type="password" >
                @if ($errors->has('password'))
                <strong>{{ $errors->first('password') }}</strong>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="example-url-input" class="col-2 col-form-label">{{ trans('profile.Repeat_The_New_Password') }} </label>
              <div class="col-10">
                <input class="form-control" name="password_confirmation " type="password" >
                @if ($errors->has('password_confirmation '))
                <strong>{{ $errors->first('password_confirmation ') }}</strong>
                @endif
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">{{ trans('profile.save') }}</button>
            </div>
          </form>
          @endisset
        </div>

      </div>
    </div>
    <!-- /.container -->
    <!-- The Modal -->
    @endsection
    @section('footer')
    @endsection