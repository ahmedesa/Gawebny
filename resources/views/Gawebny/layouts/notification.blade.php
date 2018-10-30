@auth
<li class="dropdown nav-item notificationsWrapper ">
  <a class="dropdown-toggle nav-link  NotList" id="notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    <span> <i class="fa fa-bell"></i>
      {{ trans('layout.notification') }}
      <span  class="badge badge-danger NotCount notification-icon "
        data-count="{{Auth::user()->unreadNotifications()->count()}}">
      </span>
    </span>
  </a>
  <div class="dropdown-menu" >
    <div class="dropdown-toolbar">
      <div class="dropdown-toolbar-title">Notifications (<span class="notif-count">{{Auth::user()->unreadNotifications()->count()}}</span>)</div>
    </div>
    <div class="notification">
      @if(!Auth::user()->notifications->isEmpty())
      @foreach (Auth::user()->notifications()->take(5)->get()  as $n)
      @if ($n->type == 'App\Notifications\NewAnswer')
      <a href="{{ url('question/'.$n->data['id'].''.str_slug($n->data['title'])) }}" class="dropdown-item {{$n->read_at == null ? 'unRead' : ''}}">
        <strong> {{ trans('layout.new_question') }} {{str_limit($n->data['title'] , 10)}} </strong>
        <small> {{$n->created_at->diffForHumans()}} </small>
      </a>
      @endif
      @if ($n->type == 'App\Notifications\NewUser')
      <a class="dropdown-item">{{ trans('layout.wellcome') }}</a>
      @endif
      @if ($n->type == 'App\Notifications\NewQUpvote')
      <a href="{{ url('question/'.$n->data['id'].''.str_slug($n->data['title'])) }}" class="dropdown-item {{$n->read_at == null ? 'unRead' : ''}}">
        <strong> {{ trans('layout.new_upvote') }} {{str_limit($n->data['title'] , 10)}} </strong>
        <small> {{$n->created_at->diffForHumans()}} </small>
      </a>
      @endif
      @if ($n->type == 'App\Notifications\NewMention')
      <a href="{{ url('/question/'.$n->data['question_id'].'#comment'.$n->data['id'] )}}" class="dropdown-item {{$n->read_at == null ? 'unRead' : ''}}">
        <strong> {{\App\User::find($n->data['user_id'])->name}}</strong> {{ trans('layout.new_mention') }} {{strip_tags(str_limit($n->data['body'] , 10))}}
        <small> {{$n->created_at->diffForHumans()}} </small>
      </a>
      @endif
      @endforeach
      @else
      <a class="dropdown-item">{{ trans('layout.no_notification') }}</a>
      @endif
    </div>
    <div class="dropdown-footer text-center">
      <a href="{{ url('/notification') }}">{{trans('layout.view_all')}}</a>
    </div>
  </div>
</li>
@endauth