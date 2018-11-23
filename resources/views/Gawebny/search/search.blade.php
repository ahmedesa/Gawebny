<!-- Page Content -->
@extends('Gawebny.layouts.layout')
@section('title')
{{ trans('search.search_for') }} "{{$query}}"
@endsection
@section('header')
@endsection
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@section('content')
<div class="container-custom">
  <div class="row">
    <!-- /.col-lg-6 -->
    <div class="col-lg-3">
      <div class=" aff-right">
        <div class="ui-block">
          <h6 class="my-4">{{ trans('search.by_type') }}</h6>
          <hr>
          <div class="nav flex-column nav-pills nav-stacked" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link {{request()->type == 'question' || !isset(request()->type) ? 'active' : ''}} " href="{{route('search' , array_merge(array_except(request( )->input() , ['type']) ,['type' =>'question'])) }}" >{{ trans('search.Questions') }}</a>
            <a class="nav-link {{request()->type == 'profile' ? 'active' : ''}} "  href="{{route('search' , array_merge(array_except(request( )->input() , ['type']) ,['type' =>'profile'])) }}" >{{ trans('search.profiles') }}</a>
            <a class="nav-link {{request()->type == 'answer' ? 'active' : ''}} "  href="{{route('search' , array_merge(array_except(request( )->input() , ['type']) ,['type' =>'answer'])) }}" >{{ trans('search.Answeres') }}</a>
          </div>
          <h6 class="my-4">{{ trans('search.By_Date') }}</h6>
          <div class="nav flex-column nav-pills nav-stacked" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link {{isset(request()->time) ? '' : 'active'}} "  href="{{route('search' , array_except(request( )->input() , ['time']) ) }}" >{{ trans('search.All_Time') }}</a>
            <a class="nav-link {{request()->time == 'week' ? 'active' : ''}} "  href="{{route('search' , array_merge(array_except(request( )->input() , ['time']) ,['time' =>'week'])) }}" >{{ trans('search.Past_Week') }}</a>
            <a class="nav-link {{request()->time == 'month' ? 'active' : ''}}"  href="{{route('search' , array_merge(array_except(request( )->input() , ['time']) ,['time' =>'month'])) }}" >{{ trans('search.Past_Month') }}</a>
            <a class="nav-link {{request()->time == 'year' ? 'active' : ''}}"  href="{{route('search' , array_merge(array_except(request( )->input() , ['time']) ,['time' =>'year'])) }}" >{{ trans('search.Past_Year') }}</a>
          </div>
        </div>
      </div>
    </div>
    <!-- /.col-lg-3 -->
    <!-- /.col-lg-3 -->
    <div class="col-lg-9">
      <form method="GET" action="{{ url('search') }}" class="form-inline ">
        <input class="myform-control mr-sm-2 searchInput" type="search" value="{{$query}}" name="q" aria-label="Search">
        <button style="border: none;" type="submet" class="btn btn-light"><i class="fa fa-search"></i></button>
      </form>
      <p> {{$results->count()}} {{ trans('search.result') }}</p>
      <hr>
      @foreach ($results as $q)
      @if (isset($q->question_id))
      <div class="ui-block alert alert-dismissible fade show" >
        <article class="hentry post">
          <div class="m-link">
            <a href="{{ url('/question/'.$q->question_id.'/'.str_slug($q->body)).'#comment'.$q->id}}"  >
              <div class="results">
                <h4>{!!str_limit($q->body , 300)!!}</h4>
              </div>
            </a>
            <div class="more">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          <div class="post-additional-info inline-items">
            {{ trans('search.Answer_For') }} <a href="{{ url('/question/'.$q->question_id.'/'.str_slug($q->question->title) ) }}" >{{str_limit($q->question->title , 50)}} </a>
          </div>
        </article>
      </div>
      @elseif(isset($q->title))
      <div class="ui-block alert alert-dismissible fade show" >
        <article class="hentry post">
          <div class="m-link">
            <a href="{{ url('/question/'.$q->id.'/'.str_slug($q->title)) }}"  >
              <div class="results">
                <h4>{{$q->title}}</h4>
              </div>
            </a>
            <div class="more">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          <div class="results">
            <p>{{$q->body}}
            </p>
          </div>
        </p>
        <div class="post-additional-info inline-items">
          <div class="container" >
            <div class="row">
              <div class="col-sm-5">
                <div class="row">
                  <div class="col-sm-3" >
                    <div>
                      {{$q->views}}<br>
                      {{ trans('search.views') }}
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div>
                      {{$q->votes}}<br>
                      {{ trans('search.votes') }}
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div>
                      {{$q->answer->count()}}<br>
                      {{ trans('search.answers') }}
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
                  {{ trans('search.by') }}   <a class=" post__author-name fn"
                  href="{{$q->anonymous == 1 ? '#' : url('profile/'.$q->user->id)  }}">
                  {{$q->anonymous == 1 ? trans('search.anonymous') : $q->user->name }}
                </a>
              </small>
            </div>
          </div>
        </div>
      </div>
    </article>
  </div>
  @endif
  @if (isset($q->name))
  <img class="profile-image" src="{{ asset('Gawebny/img/'.$q->image) }}" style="width: 25px;height: 25px; display: inline;">
  <div class="results">
    <a  href="{{ url('profile/'.$q->id)  }}">
      {{$q->name }} </a> <span>{{$q->jop}} , {{$q->education}}</span>
      <p>{{$q->discreption}}</p>
    </div>
  </a>
  <hr>
  @endif
  <br>
  @endforeach
  {{  $results->appends(Request::input())->links() }}
</div>
</div>
</div>
<!-- /.container -->
<!-- The Modal -->
@endsection
@section('footer')
<script type="text/javascript">
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
  });
</script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/searchHighlight.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    var searchTerm = $('.searchInput').val();
    if ( searchTerm ) {
      $('.results').highlight( searchTerm );
    }
  });
</script>
@endsection