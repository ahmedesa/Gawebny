<!-- Page Content -->
@extends('Gawebny.layouts.layout')
@section('title')
{{ trans('home.home') }}
@endsection
@section('header')

@endsection
@section('content')
<div class="container-custom">
  <div class="row">
    <!-- /.col-lg-3 -->
    <div class="col-lg-9">
      <div class="ui-block">
        <article class="hentry post">
          <div class="post__author author vcard inline-items">
            @auth
            <img style="width: 20px;
            height: 20px;" src="{{ asset('Gawebny/img/'.Auth::user()->image) }}" alt="author">
            <div class="author-date">
              <a class="h6 post__author-name fn" href="#">{{Auth::user()->name}}</a>
            </div>
            @endauth
          </div>
          <center>
            <strong >
              @auth
              <a data-toggle="modal" data-target="#exampleModal" style="color: grey" href="#">{{ trans('home.add_question') }}</a>
              @else
              <a href="{{ route('login') }}">{{ trans('home.login_to_ask') }} </a> 

              @endauth
            </strong>
          </center>
        </article>
      </div>
      <ul class="nav nav-tabs" id="myTab" role="tablist">
       <li class="nav-item">
        <a class="nav-link {{ request()->tab == 'featured' ? 'active' : '' }}" id="profile-tab"  href="{{ url('/?tab=featured') }}" role="tab" aria-controls="profile" aria-selected="false">{{ trans('home.featured') }}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->tab == 'top' ? 'active' : '' }}" id="profile-tab"  href="{{ url('/?tab=top') }}" role="tab" aria-controls="profile" aria-selected="false">{{ trans('home.top') }}</a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ request()->tab == 'random' ? 'active' : '' }}" id="profile-tab"  href="{{ url('/?tab=random') }}" role="tab" aria-controls="profile" aria-selected="false">{{ trans('home.random') }}</a>
      </li>
    </ul>
    @foreach($question as $q)
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
                      {{ trans('home.views') }}
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div>
                      {{$q->votes}}<br>
                      {{ trans('home.votes') }}
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div>
                      {{$q->answer->count()}}<br>
                      {{ trans('home.answers') }}
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
                  {{$q->anonymous == 1 ? 
                     trans('home.anonymous')  : $q->user->name }}
                  </a>
                </small>

              </div>          
            </div>
          </div>
        </div>
      </article>
    </div>
    @endforeach
    {{ $question->links() }}     

  </div>
  <!-- /.col-lg-6 -->
  <div class="col-lg-3">
    <div class=" aff-right">
      <div class="ui-block">
        <h6 class="my-4">{{ trans('home.Categories') }}</h6>
        <hr>
        <div class="nav flex-column nav-pills nav-stacked" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          @foreach (App\Category::all() as $cat)
          <a class="nav-link {{ request()->is('category/'.$cat->name_en) ? 'active' : '' }}"  href="{{ url('/category/'.$cat->name_en) }}" >{{$cat->name()}}</a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <!-- /.col-lg-3 -->
</div>
</div>
<!-- /.container -->
<!-- The Modal -->
@endsection
@section('footer')

@endsection