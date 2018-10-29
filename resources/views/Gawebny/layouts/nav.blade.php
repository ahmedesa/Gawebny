<nav class="navbar navbar-expand-lg navbar-light fixed-top">
  <div class="container">
    <a style="
    background-image: url('{{ asset('Gawebny/img/'.\App\SiteSetting::where('name' ,'logo')->first()->value) }}');"
    
    class="navbar-brand mylogo" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{ url('/') }}"><i class="fa fa-home"></i> {{ trans('layout.home') }}</a>
        </li>
        @auth

        <li class="dropdown nav-item  ">
          <a class="dropdown-toggle nav-link  NotList" id="notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <span> <i class="fa fa-bell"></i> 
              {{ trans('layout.notification') }} 

              @if(Auth::user()->unreadNotifications()->count() != 0 )
              <span class="badge badge-danger NotCount">{{Auth::user()->unreadNotifications()->count()}}</span> </span>
              @endif
          </a>

          <div class="dropdown-menu" >
            <div class="dropdown-toolbar">
              {{--<div class="dropdown-toolbar-actions">
                <a href="#">Mark all as read</a>
                <hr>
              </div> --}}
            </div> 
            @if(!Auth::user()->notifications->isEmpty())

            @foreach (Auth::user()->notifications()->take(5)->get()  as $n)
            @if ($n->type == 'App\Notifications\NewAnswer')
            <a href="{{ url('question/'.$n->data['id'].''.str_slug($n->data['title'])) }}" class="dropdown-item {{$n->read_at == null ? 'unRead' : ''}}">
             <strong> {{ trans('layout.new_question') }} {{str_limit($n->data['title'] , 10)}} </strong>  
             {{$n->markAsRead()}}
             <small> {{$n->created_at->diffForHumans()}} </small>
           </a>
           @endif
           @if ($n->type == 'App\Notifications\NewUser')
           <a class="dropdown-item">{{ trans('layout.wellcome') }}</a>
                        {{$n->markAsRead()}}

           @endif
           @if ($n->type == 'App\Notifications\NewQUpvote')
           <a href="{{ url('question/'.$n->data['id'].''.str_slug($n->data['title'])) }}" class="dropdown-item {{$n->read_at == null ? 'unRead' : ''}}">
             <strong> {{ trans('layout.new_upvote') }} {{str_limit($n->data['title'] , 10)}} </strong>  
             {{$n->markAsRead()}}
             <small> {{$n->created_at->diffForHumans()}} </small>
           </a>          
           @endif
           @if ($n->type == 'App\Notifications\NewMention')
           <a href="{{ url('/question/'.$n->data['question_id'].'#comment'.$n->data['id'] )}}" class="dropdown-item {{$n->read_at == null ? 'unRead' : ''}}">
             <strong> {{\App\User::find($n->data['user_id'])->name}} {{ trans('layout.new_mention') }} {{strip_tags(str_limit($n->data['body'] , 10))}} </strong>  
             {{$n->markAsRead()}}
             <small> {{$n->created_at->diffForHumans()}} </small>
           </a>          
           @endif
           @endforeach
           @else
           <a class="dropdown-item">{{ trans('layout.no_notification') }}</a>
           @endif

           <div class="dropdown-footer text-center">
            <hr>
            <a href="{{ url('/notification') }}">{{trans('layout.view_all')}}</a>
          </div>


        </div>
      </li>
      @endauth
    </ul>
    <form method="GET" action="{{ url('search') }}" class="form-inline my-2 my-lg-0 col-md-5">
      <input class="myform-control mr-sm-2" name="q" type="search" placeholder="{{ trans('layout.search') }}" aria-label="Search">
      <button style="border: none;" class="btn btn-light"><i class="fa fa-search"></i></button>
    </form>
    <ul class="navbar-nav ml-auto">
      @auth
      <li>
        <button data-toggle="modal" data-target="#exampleModal" id="add-question" class="btn mybtn btn-success">{{ trans('layout.add_question') }}</button>
      </li>
      @endauth

      @guest
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">{{ trans('layout.login') }}</a>

      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('set.language', 'ar') }}">العربية</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('set.language', 'en') }}">english</a>
      </li>
      @else
      <li class="avatar-profile d-none d-sm-block ">
        <a href="#" ><img src="{{ asset('Gawebny/img/'.Auth::user()->image) }}" class="img-responsive" /></a>
      </li>
      <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
          {{ Auth::user()->name }} <span class="caret"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ url('profile/'.Auth::id()) }}">
            {{ trans('layout.profile') }}
          </a>
          <a class="dropdown-item" href="{{ url('settings/information') }}">
            {{ trans('layout.settings') }}
          </a>
          <a class="dropdown-item" href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          {{ trans('layout.logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        <hr>
        <a class="dropdown-item" href="{{ route('set.language', 'en') }}">english</a>
        <a class="dropdown-item" href="{{ route('set.language', 'ar') }}">العربية</a>
      </div>
    </li>
    @endguest

  </ul>
</div>
</div>
</nav>