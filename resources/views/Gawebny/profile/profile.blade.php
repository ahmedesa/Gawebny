<!-- Page Content -->
@extends('Gawebny.profile.layout')
@section('profile_content')
{{$user->question->count()}} {{ trans('profile.Questions') }}
<hr>
<ul class="nav nav-tabs" id="myTab" role="tablist">
 <li class="nav-item">
  <a class="nav-link {{ request()->order == 'recnet' ? 'active' : '' }}" id="profile-tab"  href="{{ url('profile/'.$user->id.'/?order=recnet') }}" role="tab" aria-controls="profile" aria-selected="false">{{ trans('profile.Most_Recent') }}</a>
</li>
<li class="nav-item">
  <a class="nav-link {{ request()->order == 'votes' ? 'active' : '' }}" id="profile-tab"  href="{{ url('profile/'.$user->id.'/?order=votes') }}" role="tab" aria-controls="profile" aria-selected="false">{{ trans('profile.Top_Voted') }}</a>
</li>
</ul> 
@foreach($user_questions as $q)
<div class="ui-block alert alert-dismissible fade show" >
  <article class="hentry post">
    <div class="m-link">
      <a href="{{ url('/question/'.$q->id.'/'.str_slug($q->title)) }}"  >
        <h4>{{$q->title}}</h4>
      </a>
      <div class="more">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
    <div class="post-additional-info inline-items">
      <div class="container" >
        <div class="row">
          <div class="col-sm-5">
            <div class="row">
              <div class="col-sm-3" >
                <div>
                  {{$q->views}}<br>
                  {{ trans('profile.views') }}
                </div>
              </div>
              <div class="col-sm-3">
                <div>
                  {{$q->votes}}<br>
                  {{ trans('profile.votes') }}
                </div>
              </div>
              <div class="col-sm-3">
                <div>
                  {{$q->answer->count()}}<br>
                  {{ trans('profile.answer') }}
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-5">
            @foreach ($q->category as $cat)
            <button class="btn  btn-default btn-sm"  style=" color: #3490dc;" onclick="location.href = '{{ url('/category/'.$cat->name_en) }}';">{{$cat->name()}}</button>
            @endforeach
          </div>
          <div class="col-sm-2">
            <small> {{$q->created_at->diffForHumans()}} 
              by   <a class=" post__author-name fn" 
              href="{{$q->anonymous == 1 ? '#' : url('profile/'.$q->user->id)  }}">
              {{$q->anonymous == 1 ? trans('profile.anonymous') : $q->user->name }}
            </a>
          </small>

        </div>          
      </div>
    </div>
  </div>
</article>
</div>
@endforeach
{{ $user_questions->appends(Request::input())->links() }}

@endsection