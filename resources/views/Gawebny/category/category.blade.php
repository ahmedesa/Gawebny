
<!-- Page Content -->
@extends('Gawebny.layouts.layout')
@section('title')
{{$category[0]->name_en}}
@endsection
@section('header')
@endsection
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@section('content')
<div class="container-custom">
  <div class="row">
    <!-- /.col-lg-3 -->
    <div class="col-lg-9">
      <div class="ui-block">
        <article class="hentry post">
          <div class="post__author author vcard inline-items">
            <strong>{{ trans('category.category') }}[{{$category[0]->name()}}] </strong> {{$questioncount}} {{ trans('category.question') }}
          </div>
          <center>


          </center>
        </article>
      </div>

          <ul class="nav nav-tabs" id="myTab" role="tablist">
         <li class="nav-item">
          <a class="nav-link {{ request()->tab == 'featured' ? 'active' : '' }}" id="profile-tab"  href="{{ url('/category/'.$category[0]->name_en.'?tab=featured') }}" role="tab" aria-controls="profile" aria-selected="false">{{ trans('category.featured') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->tab == 'top' ? 'active' : '' }}" id="profile-tab"  href="{{ url('/category/'.$category[0]->name_en.'?tab=top') }}" role="tab" aria-controls="profile" aria-selected="false">{{ trans('category.top') }}</a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->tab == 'random' ? 'active' : '' }}" id="profile-tab"  href="{{ url('/category/'.$category[0]->name_en.'?tab=random') }}" role="tab" aria-controls="profile" aria-selected="false">{{ trans('category.random') }}</a>
        </li>
      </ul>
     @foreach($question as $q)
     <div class="ui-block alert alert-dismissible fade show" >
      <article class="hentry post">
        <div class="m-link">
          <a href="{{ url('/question/'.$q->id.'/'.str_slug($q->title)) }}">
            <h4>{{$q->title}}</h4>
          </a>
        </div>
        <div class="post__author author vcard inline-items">
          <img src="{{ asset('Gawebny/img/'.$q->user->image) }}" alt="author">
          <div class="author-date">
            <a class="h6 post__author-name fn" href="{{ url('profile/'.$q->user->id) }}">{{ $q->user->name }}</a>
            <div class="post__date">
              <time class="published" datetime="2004-07-24T18:18">
                <small> {{$q->created_at->diffForHumans()}} </small>
              </time>
            </div>
          </div>
          <div class="more">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
        <p>{{$q->body}}
        </p>
        <div class="post-additional-info inline-items">
          <div class="container" >
            <div class="row">
              <div class="col-sm-6">
                <div class="row">
                  <div class="col-sm-3" >
                    <div>
                      {{$q->views}}<br>
                      {{ trans('category.views') }}
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div>
                      {{$q->votes}}<br>
                      {{ trans('category.votes') }}
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div>
                       {{$q->answer->count()}}<br>
                      {{ trans('category.answers') }}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                @foreach ($q->category as $cat)
                <button type="button" class="btn  btn-default btn-sm"><a href="{{ url('/category'.$cat->name_en) }}">{{$cat->name()}}</a> </button>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </article>
    </div>
    @endforeach

  </div>
  <!-- /.col-lg-6 -->
  <div class="col-lg-3">
    <div class=" aff-right">
      <div class="ui-block">
        <h6 class="my-4">{{ trans('category.Categories') }}</h6>
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
