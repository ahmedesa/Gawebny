<!-- Page Content -->
@extends('Gawebny.layouts.layout')
@section('title')
{{$user->name}}
@endsection
@section('content')
<div class="container-custom">
  <div class="row">
    <!-- /.col-lg-3 -->
    <div class="col-lg-9">
      <div class="row">
        <div  class="col-lg-3">
          <div  class="  ">
            <a href="#" ><img src="{{ asset('Gawebny/img/'.$user->image) }}" class="img-responsive profile-image" /></a>
          </div>
        </div>
        <div  class="col-lg-9">
          <h1 class="profile-name">{{$user->name}}
          </h1>
          <div class="post__date">
            <div style="font-family: 'q_serif',Georgia,Times,'Times New Roman','Hiragino Kaku Gothic Pro','Meiryo',serif; " >
              {{$user->jop}}
            </div>
          </div>
          <div class="more float-right">
            <div class="dropdown">
              <button style="background: transparent; color: #777;" class="btn btn-default" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa  fa-chevron-down"></i>
              </button>
              @auth
              @if($user->id != Auth::id())
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a data-toggle="modal" data-target="#ReportModel" class="dropdown-item" href="#">{{ trans('profile.Report_this_account') }}  <i class="fa fa-ban"></i></a>
              </div>
              @endif
              @endauth
            </div>
          </div>
          <p>
            {{$user->discreption}}
          </p>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-lg-3">
          <div class=" q-wid">
            <div class="ui-block">
              <div class="nav flex-column nav-pills nav-stacked" id="v-pills-tab"  aria-orientation="vertical">
                <a class="nav-link {{request()->is('profile/'.$user->id) ? 'active' : ''}}" href="{{ url('profile/'.$user->id) }}"  >{{ trans('profile.Questions') }} {{$user->question->count()}} </a>
                <a class="nav-link {{request()->is('profile/'.$user->id.'/answers') ? 'active' : ''}}"  href="{{ url('profile/'.$user->id.'/answers') }}"   >{{ trans('profile.Answers') }} {{$user->answer->count()}} </a>
                {{--
                <a class="nav-link {{request()->is('profile/'.$user->id.'/votes') ? 'active' : ''}}"  href="{{ url('profile/'.$user->id.'/votes') }}"    >Votes {{$user->CountVotes()}} </a>
                --}}
                <a class="nav-link {{request()->is('profile/'.$user->id.'/saved') ? 'active' : ''}}"  href="{{ url('profile/'.$user->id.'/saved') }}"   > {{ trans('profile.Saved') }} <i class="fa fa-bookmark"></i> {{$user->savedQ()->count()}} </a>
              </div>
            </div>
          </div>
        </div>
        <div  class="col-lg-9">
          @yield('profile_content')
        </div>
      </div>
    </div>
    <!--col-lg-3-->
    <div class="col-lg-3">
      <div class=" q-wid">
        {{ trans('profile.Credentials_Highlights') }}
        @if ($user->id == Auth::id())
        <a href="{{ url('/settings/information') }}">   <button type="button" class="btn btn-link">{{ trans('profile.Edit') }}</button> </a>
        @endif
        <hr>
        <div class="nav flex-column nav-pills nav-stacked"   aria-orientation="vertical">
          <a><i class="fa fa-clock-o"></i> {{ trans('profile.Member_for') }}  {{$user->created_at->diffForHumans()}}</a>
          @isset ($user->jop)
          <a><i class="fa fa-suitcase" ></i> {{$user->jop}} </a>
          @else
          @if($user->id == Auth::id())
          <a href="{{ url('settings/information') }}"><i class="fa fa-suitcase" ></i>     {{ trans('profile.Add_employment_credential') }} </a>
          @endif
          @endisset
          @isset ($user->education)
          <a><i class="fa fa-mortar-board "></i> {{$user->education}} </a>
          @else
          @if($user->id == Auth::id())
          <a href="{{ url('settings/information') }}"><i class="fa fa-mortar-board "></i> {{ trans('profile.Add_education_credential') }}  </a>
          @endif
          @endisset
          @isset ($user->country_id)
          <a><i class="fa fa-map-marker" ></i> {{$user->location->name()}} </a>
          @else
          @if($user->id == Auth::id())
          <a href="{{ url('settings/information') }}"><i class="fa fa-map-marker" ></i>  {{ trans('profile.Add_a_location_credential') }} </a>
          @endif
          @endisset
          @isset ($user->language_id)
          <a><i class="fa fa-language" ></i> {{$user->language->name}} </a>
          @else
          @if($user->id == Auth::id())
          <a href="{{ url('settings/information') }}"><i class="fa fa-language"></i>      {{ trans('profile.Add_language_credential') }}   </a>
          @endif
          @endisset
        </div>
      </div>
    </div>
    <!-- /.col-lg-3 -->
  </div>
</div>
<!--user Report Model -->
<div class="modal fade" id="ReportModel" tabindex="-1" role="dialog" aria-labelledby="ReportModel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ trans('profile.Report') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="Post" action="{{ url('/reprot') }}" >
          @csrf
          <div class="form-group">
            <label  class="col-form-label">{{ trans('profile.Report_Details') }}</label>
            <textarea name="details" required class="form-control"></textarea>
            <input type="hidden" name="user_id" value="{{Auth::id()}}">
            <input type="hidden" name="type" value="user">
            <input type="hidden" name="reported_id" value="{{$user->id}}">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{ trans('profile.Report') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('footer')
@endsection