@extends('Gawebny.profile.layout')
@section('profile_content')
{{$user->answer->count()}} {{ trans('profile.Answers') }}
<hr>
<ul class="nav nav-tabs" id="myTab" role="tablist">
	<li class="nav-item">
		<a class="nav-link {{ request()->order == 'recnet' ? 'active' : '' }}" id="profile-tab"  href="{{ url('profile/'.$user->id.'/answers/?order=recnet') }}" role="tab" aria-controls="profile" aria-selected="false">{{ trans('profile.Most_Recent') }}</a>
	</li>
	<li class="nav-item">
		<a class="nav-link {{ request()->order == 'votes' ? 'active' : '' }}" id="profile-tab"  href="{{ url('profile/'.$user->id.'/answers/?order=votes') }}" role="tab" aria-controls="profile" aria-selected="false">{{ trans('profile.Top_Voted') }}</a>
	</li>
</ul>
@foreach($user_answers as $ans)
<div class="ui-block alert alert-dismissible fade show" >
	<article class="hentry post">
		<div class="m-link">
			<a href="{{ url('/question/'.$ans->question_id.'/'.str_slug($ans->body)).'#comment'.$ans->id}}"  >
				<h4>{!!str_limit($ans->body , 80)!!}</h4>
			</a>
			<div class="more">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
		<div class="post-additional-info inline-items">
			{{ trans('profile.Answer_For') }} <a href="{{ url('/question/'.$ans->question_id.'/'.str_slug($ans->question->title) ) }}" >{{str_limit($ans->question->title , 50)}} </a>
		</div>
		<div class="post-additional-info inline-items">
			<div class="container">
				<div class="row">
					<div class ="col-6">{{ trans('profile.votes') }} : {{$ans->votes}}</div>
					<div class ="col-6">
						<time class="published" datetime="2004-07-24T18:18">
							<small> {{$ans->created_at->diffForHumans()}} </small>
						</time>
					</div>
				</div>
			</div>
		</div>
	</article>
</div>
@endforeach
{{ $user_answers->appends(Request::input())->links() }}
@endsection