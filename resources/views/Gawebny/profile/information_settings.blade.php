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
            <a class="nav-link {{request()->is('settings') ? 'active' : ''}}"  href="{{ url('settings') }}" >{{ trans('profile.Account_Settings') }}</a>
          </div>

        </div>
      </div>
    </div>
    <!-- /.col-lg-3 -->
    <!-- /.col-lg-3 -->
    <div class="col-lg-9">
      <p> {{ trans('profile.Edit_Information') }}
        <hr>
        <form method="Post" action="{{ url('settings') }}" enctype="multipart/form-data" >
          @csrf
          @method('PUT')
          <div class="form-group row">
            <label for="category-text" class="col-2 col-form-label">{{ trans('profile.Language') }}</label>
            <div class="col-10">
              <select  class="language-select form-control " name="language_id">
                @foreach (App\Language::all() as $lang)
                <option {{$user->language_id == $lang->id ? 'selected ="selected"'  :''}} value="{{$lang->id}}">{{$lang->name}}</option>
                @endforeach
              </select>
              @if ($errors->has('language_id'))
              <strong>{{ $errors->first('language_id') }}</strong>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label  class="col-2 col-form-label">{{ trans('profile.Country') }}</label>
            <div class="col-10">
              <select   class="language-select form-control " name="country_id">
                @foreach (App\Country::all() as $cou)
                <option {{$user->country_id == $cou->id ? 'selected ="selected"'  :''}} value="{{$cou->id}}">{{$cou->name()}}</option>
                @endforeach
              </select>
              @if ($errors->has('country_id'))
              <strong>{{ $errors->first('country_id') }}</strong>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">jop</label>
            <div class="col-10">
              <input class="form-control" type="text" value="{{$user->jop}}" id="example-text-input" name="jop">
              @if ($errors->has('jop'))
              <strong>{{ $errors->first('jop') }}</strong>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">{{ trans('profile.education') }}</label>
            <div class="col-10">
              <input class="form-control" type="text" value="{{$user->education}}" id="example-text-input" name="education">
              @if ($errors->has('education'))
              <strong>{{ $errors->first('education') }}</strong>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label">{{ trans('profile.discreption') }}</label>
            <div class="col-10">
              <textarea class="form-control" name="discreption" value="{{$user->discreption}}" id="example-search-input"> </textarea>
              @if ($errors->has('discreption'))
              <strong>{{ $errors->first('discreption') }}</strong>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label for="example-url-input" class="col-2 col-form-label">{{ trans('profile.connection_account') }}</label>
            <div class="col-10">
              <input class="form-control" name="connection_account" type="url" value="{{$user->connection_account}}" id="example-url-input">
              @if ($errors->has('connection_account'))
              <strong>{{ $errors->first('connection_account') }}</strong>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label for="example-url-input" class="col-2 col-form-label">{{ trans('profile.image') }}</label>
            <div class="col-10">
             @isset ($user->image)
             <img class ="profile-image" src="{{ asset('Gawebny/img/'.$user->image) }}">
             @endisset
             <br>
             <input class="form-control" name="image" value="null" type="file" id="example-url-input">

             @if ($errors->has('image'))
             <strong>{{ $errors->first('image') }}</strong>
             @endif
           </div>
         </div>

         <div class="modal-footer">
          <button type="submit" class="btn btn-primary">{{ trans('profile.Save') }}</button>
        </div>
      </div>

    </form>
  </div>
</div>
<!-- /.container -->
<!-- The Modal -->
@endsection
@section('footer')

<script type="text/javascript">
  $(document).ready(function() {
    $('.language-select').select2();
  });
</script> 

@endsection