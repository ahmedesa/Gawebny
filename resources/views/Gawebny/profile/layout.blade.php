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
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#">Another action</a>
            </div>
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

@endsection
@section('footer')

@endsection