<article class="hentry post">
  <!-- /.card -->
  <h1>{{$answerCount}} {{ trans('question.Answers') }}</h1>
  @foreach ($all_answeres as $ans)
  <hr>
  <div  class="ui-block {{$ans->best == 1 ? 'bestans' : '' }}" id="comment{{$ans->id}}">
    <article class="hentry post">
      <div class="post__author author vcard inline-items">
        <img src="{{ asset('Gawebny/img/'.$ans->user->image) }}" alt="author">
        <div class="author-date">
          <a class="h6 post__author-name fn" href="{{ url('profile/'.$ans->user->id) }}">{{$ans->user->name}}</a>
          <div class="post__date">
            <time class="published" datetime="2004-07-24T18:18">
            <small> {{ trans('question.Answerd') }} {{$ans->created_at->diffForHumans()}} </small>
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
              @if ($ans->user_id == Auth::id())
              <a class="dropdown-item" href="{{ url('/answer/'.$ans->id) }}"
                onclick="event.preventDefault();
                document.getElementById('deleteAns{{$ans->id}}-form').submit();">
                {{ trans('question.Delete') }}
                <i class="fa  fa-trash"></i>
              </a>
              <form id="deleteAns{{$ans->id}}-form" action="{{ url('/answer/'.$ans->id) }}" method="POST" style="display: none;">
                @csrf
                {{ method_field('DELETE') }}
              </form>
              @if ($question->user->id ==Auth::id() )
              <a class="dropdown-item" href="{{ url('makebest/'.$ans->id) }}">{{ trans('question.choose_best') }}<i class="fa fa-check"></i></a>
              @endif
              @endif
              {{--}}   @if ($ans->user_id != Auth::id()) {{--}}
              <a data-toggle="modal" data-target="#ReportAnsModel" data-id="{{$ans->id}}" class="dropdown-item Report_question" href="#">{{ trans('question.Report_this_answer') }}  <i class="fa fa-ban"></i></a>
              {{--}}   @endif {{--}}
              @endauth
            </div>
          </div>
        </div>
      </div>
      <p>{!!$ans->body !!}
      </p>
      <div class="post-additional-info inline-items">
        <a href="#" data-aid="{{$ans->id}}" class="btn btn-sm btn-light upvote_ans {{ \App\AVote::isUpVoted(Auth::id() , $ans->id) ? 'isVoted' : '' }} "><span id="AnsVotesCount"> {{$ans->votes}} </span> {{ trans('question.votes') }} <i class=" fa fa-arrow-circle-up fa-lg"></i> </a>
        <a href="#" data-aid="{{$ans->id}}" class="btn btn-sm btn-light downvote_ans {{ \App\AVote::isDownVoted(Auth::id() , $ans->id) ? 'isVoted' : '' }} "> <i class=" fa fa-arrow-circle-down fa-lg"></i> </a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=YourPageLink.com&display=popup" class="btn btn-sm btn-light"><i class="fa fa-facebook fa-lg"></i></a>
        @if ($ans->best == 1)
        <span ><i class="fa fa-check">{{ trans('question.Best_Answer') }}</i></span>
        @endif
      </div>
    </article>
  </div>
  @endforeach
  <!-- /.card -->
  <form method="Post" action="{{ url('answer') }}" >
    @csrf
    <div class="second">
      <input name="question_id" value="{{$question->id}}" type="hidden">
      <textarea class="textarea1" name="answer"></textarea>
    </div>
    <ul class="social-btns center-block">
      @guest
      <p> {{ trans('question.sign_to_answer') }}</p>
      <a href="{{ url('login/facebook') }}"> <li><button class="btn btn-facebook"><i class="fa fa-facebook pull-left" aria-hidden="true"></i>{{ trans('question.fsign') }}</button></li> </a>
      <a href="{{ url('login/google') }}"> <li><button class="btn btn-google"><i class="fa fa-google-plus pull-left" aria-hidden="true"></i>{{ trans('question.gsign') }}</button></li> </a>
      <a href="{{ url('login') }}">   <li><button class="btn btn-Gawebny">{{ trans('question.email_sign') }}</button></li> </a>
      @else
      <li> <button type="submit" style="color: white;" class="btn btn-Gawebny">{{ trans('question.post') }} </button> </li>
      @endguest
    </ul>
  </form>
</article>