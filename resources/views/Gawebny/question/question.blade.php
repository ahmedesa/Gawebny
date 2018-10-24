<!-- Page Content -->
@extends('Gawebny.layouts.layout')
@section('title')
{{str_limit($question->title , 10)}}
@endsection
@section('header')
<link rel="stylesheet" href="{{ asset('css/jquery.atwho.min.css') }}">
@endsection
@section('content')
<div class="container-custom">
  <div class="row">
    <!-- /.col-lg-3 -->
    <div class="col-lg-9">
      @foreach ($question->category as $cat)
      <button class="btn  btn-default btn-sm"  style=" color: #3490dc;" onclick="location.href = '{{ url('/category/'.$cat->name_en) }}';">{{$cat->name()}}</button>
      @endforeach
      <div class="ui-block">
        <article class="hentry post">
          <div class="m-link">
            <h4>{{$question->title}}</h4>
          </div>
          <div class="post__author author vcard inline-items">
            <img src="{{ asset('Gawebny/img/'.$question->user->image) }}" alt="author">
            <div class="author-date">
              <a class="h6 post__author-name fn" href="{{ url('profile/'.$question->user->id) }}">{{ $question->user->name }}</a>
              <div class="post__date">
                <time class="published" datetime="2004-07-24T18:18">
                  <small> {{$question->created_at->diffForHumans()}} </small>
                </time>
              </div>
            </div>
            <div class="more">
              <div class="dropdown">
                <button style="background: transparent; color: #777;" class="btn btn-default" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-ellipsis-v"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  @auth
                  @if ($question->user->id == Auth::id())
                  <a class="dropdown-item" href="{{ url('/question/'.$question->id) }}"
                    onclick="event.preventDefault();
                    document.getElementById('deleteQuestion-form').submit();">
                    {{ trans('question.Delete') }}
                    <i class="fa fa-trash"></i>
                  </a>
                  <form id="deleteQuestion-form" action="{{ url('/question/'.$question->id) }}" method="POST" style="display: none;">
                    @csrf
                    {{ method_field('DELETE') }}
                  </form>
                  <a data-toggle="modal" data-target="#QuestionsModel" id="add-question" class="dropdown-item" href="#">{{ trans('question.Edit') }}  <i class="fa fa-edit" ></i></a>
                  @endif
                  @if ($question->user->id != Auth::id())
                  <a class="dropdown-item" href="{{ url('/question/save/'.$question->id) }}">save <i class="fa fa-bookmark"></i></a>
                  <a data-toggle="modal" data-target="#ReportModel" id="add-question" class="dropdown-item" href="#">{{ trans('question.Report_this_question') }}  <i class="fa fa-ban"></i></a>
                  @endif
                  @endauth
                </div>
              </div>
            </div>
          </div>
          <p>{{$question->body}}
          </p>
          <div class="post-additional-info inline-items">
            <p>
              <button class="btn btn-sm btn-light first`border answer1" type="button"><span style="color: rgb(50, 155, 255)" class="fa  fa-pencil-square-o"></span> {{ trans('question.Answer') }}</button>
            </p>
            <p class="social-icons">
              <a  class="btn btn-sm btn-light upvote_q  {{ \App\QVote::isUpVoted(Auth::id() , $question->id) ? 'isVoted' : '' }}
                " href="#"><span id="QVotesCount">{{$question->votes}}</span>  {{ trans('question.votes') }} <i class=" fa fa-arrow-circle-up fa-lg"></i> <a>
                  <a class="btn btn-sm btn-light downvote_q  {{ \App\QVote::isDownVoted(Auth::id() , $question->id) ? 'isVoted' : '' }}"  href="#"><i class=" fa fa-arrow-circle-down fa-lg"></i></a>
                  <a href="https://www.facebook.com/sharer/sharer.php?u=YourPageLink.com&display=popup" class="btn btn-sm btn-light"><i class="fa fa-facebook fa-lg"></i></a>
                </p>
              </div>
            </article>
          </div>
          @include('Gawebny.question.AnswerSection')
        </div>
        <!--col-lg-3-->
        <div class="col-lg-3">
          <div class=" q-wid">
            <h6 class="my-4">{{ trans('question.Related_Questions') }}</h6>
            <hr>
            <div class="nav flex-column nav-pills nav-stacked"   aria-orientation="vertical">
              @foreach ($relatedQuestion as $related)
              <a   href="{{ url('/question/'.$related->id.'/'.str_slug($related->title)) }}"  >  {{$related->title}}</a>
              @endforeach
            </div>
          </div>
        </div>
        <!-- /.col-lg-3 -->
      </div>
    </div>
    <!-- Modal -->
    @include('Gawebny.question.ActionModels')
    @endsection
    @section('footer')
    <script type="text/javascript">
      var token = '{{ Session::token() }}';
      var urlUpvoteQ = '{{ url('question/upvote') }}';
      var urlDownvoteQ = '{{ url('question/downvote') }}';
      var question_id = '{{ $question->id }}';
      var urlUpvoteAns = '{{ url('answer/upvote') }}';
      var urlDownvoteAns = '{{ url('answer/downvote') }}';
    </script>
    <script type="text/javascript" src="{{ asset('js/jquery.atwho.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/votes.js') }}" ></script>
    @if($locale =='ar' )
    <script src='{{ asset('js/ar.js') }}'></script>
    @endif
    <script type="text/javascript">
      $(".answer1").click(function() {
        $('html,body').animate({
          scrollTop: $(".second").offset().top},
          'slow');
      });
    </script>
    <!-- Include At.JS javascript. -->
    <script>
      $(function() {
  // Define data source for At.JS.
  var datasource =  [
  @foreach(\App\User::all() as $user)
  {
    id :{{$user->id}},
    fullname: '{{$user->name}}',
    image: '{{$user->image}}'
  },
  @endforeach
  ];
  // Build data to be used in At.JS config.
  var names = $.map(datasource, function (value) {
    return {
      'name': value.fullname,
      'image':'{{ asset('Gawebny/img') }}/'+value.image ,
      'id':'{{ url('profile') }}/'+value.id
    };
  });
  // Define config for At.JS.
  var config = {
    at: "@",
    data: names,
    displayTpl: '<li>${name}<img class="mention_image" src="${image}" ></li>',
    limit: 5 ,
    insertTpl: "<a href='${id}'> @${name} <a>",
  }
    // Initialize editor.
    $('.textarea1')
    .on('froalaEditor.initialized', function (e, editor) {
      editor.$el.atwho(config);
      editor.events.on('keydown', function (e) {
        if (e.which == $.FroalaEditor.KEYCODE.ENTER && editor.$el.atwho('isSelecting')) {
          return false;
        }
      }, true);
    })
    .froalaEditor({
      @if($locale =='ar' )
      language: 'ar'
      @endif
    })
  });
</script>
<script type="text/javascript">
  
  $(document).on("click", ".Report_question", function () {
     var AnsId = $(this).data('id');
     $(".modal-body #AnsId").val( AnsId );
});
</script>
@endsection